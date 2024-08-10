import axios from "axios";

export default function () {
    return {
        storeUrl: null,

        deleteUrl: null,

        missionType: 'new',

        mission_id: null,

        missionTasks: [],

        lastMissionTask: {},

        quranAyas: [],

        missionSurats: [],

        fromSurat: null,

        toSurats: [],

        toSurat: null,

        fromAyas: [],

        fromAya: null,

        toAyas: [],

        toAya: null,

        descr: "",

        allow_wrong: 1,

        showOrderOptions: false,

        data: {},

        step: "select-from-surats",

        loading: false,

        showButton: false,

        /*--- in order to change task order ---*/
        selectLastMissionTask(id) {
            this.lastMissionTask = this.missionTasks.find((mt) => mt.id == id);

            this.showOrderOptions = false;

            this.data.selectedMissionTaskOrder =
                this.lastMissionTask.task_order;
        },

        selectFromSuratId(id) {
            this.fromSurat = this.missionSurats.find((surat) => surat.id == id);

            this.descr = "من سورة" + this.fromSurat.title + "  من الآية";

            this.fromAyas = this.quranAyas.filter(
                (aya) => aya.quran_surat_id == this.fromSurat.id
            );

            this.step = "select-from-ayas";
        },

        selectFromAyaId(id) {
            this.fromAya = this.fromAyas.find((aya) => aya.id == id);

            this.toSurats = this.missionSurats.filter(
                (surat) => surat.id >= this.fromSurat.id
            );

            this.descr = this.descr + " " + this.fromAya.number + " إلى سورة";

            this.fromAyas = [];

            this.step = "select-to-surats";
        },

        selectToSuratId(id) {
            this.toSurat = this.toSurats.find((surat) => surat.id == id);

            this.descr = this.descr + this.toSurat.title + " الآية";

            this.toAyas = this.quranAyas.filter((aya) => {
                if (this.fromSurat.id == this.toSurat.id) {
                    return (
                        aya.quran_surat_id == this.toSurat.id &&
                        aya.number >= this.fromAya.number
                    );
                }
                return aya.quran_surat_id == this.toSurat.id;
            });

            this.toSurats = [];

            this.step = "select-to-ayas";
        },

        selectToAyaId(id) {
            this.toAyaId = this.toAyas.find((aya) => aya.id == id);

            this.descr = this.descr + " " + this.toAyaId.number;

            this.toAyas = [];

            this.data.fromSurat = this.fromSurat;

            this.data.fromAya = this.fromAya;

            this.data.toSurat = this.toSurat;

            this.data.toAya = this.toAya;

            this.data.descr = this.descr;

            this.showButton = true;
        },

        reset() {
            this.descr = "";

            this.fromSurat = null;

            this.toSurat = null;

            this.toSurats = [];

            this.fromAya = null;

            this.fromAyas = [];

            this.toAya = null;

            this.toAyas = [];

            this.data = {};

            this.loading = false;

            this.showButton = false;

            this.step = "select-from-surats";
        },

        incAllowWrong() {
            if (this.allow_wrong < 5) {
                this.allow_wrong = this.allow_wrong + 1;
            }
        },

        decAllowWrong() {
            if (this.allow_wrong != 0) {
                this.allow_wrong = this.allow_wrong - 1;
            }
        },

        save() {
            this.loading = true;

            this.data.descr = this.descr;

            this.data.selectType = "suratToSurat";

            this.data.mission_type = this.missionType;

            this.data.mission_id = this.mission_id;

            this.data.allow_wrong = this.allow_wrong;

            axios
                .post(this.storeUrl, this.data)
                .then((res) => {
                    this.missionTasks = res.data;

                    this.lastMissionTask = this.missionTasks[0];

                    this.loading = false;
                })
                .catch((e) => {
                    console.log(e);
                });

            this.reset();
        },

        Delete(id) {
            this.loading = true;
            axios
                .post(this.deleteUrl, { id: id, mission_id: this.mission_id })
                .then((res) => {
                    this.missionTasks = res.data;

                    this.lastMissionTask = this.missionTasks[0];

                    this.loading = false;
                })
                .catch((e) => {
                    return console.log(e);
                });
        },
    };
}
