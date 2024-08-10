import axios from "axios";

export default function () {
    return {
        storeUrl: null,

        deleteUrl: null,

        missionType: 'new',

        mission_id: null,

        missionTasks: [],

        lastMissionTask: {},

        missionSurats: [],

        fromSurat: null,

        toSurats: [],

        toSurat: null,

        descr: "",

        allow_wrong:1,

        showOrderOptions: false,

        data: {},

        /*--- in order to change task order ---*/
        selectLastMissionTask(id) {
            this.lastMissionTask = this.missionTasks.find((mt) => mt.id == id);

            this.showOrderOptions = false;

            this.data.selectedMissionTaskOrder =
                this.lastMissionTask.task_order;
        },

        selectFromSuratId(id) {
            this.fromSurat = this.missionSurats.find((surat) => surat.id == id);

            this.descr = "من سورة" + this.fromSurat.title + " إلى سورة ";

            this.toSurats = this.missionSurats.filter(
                (surat) => surat.id > this.fromSurat.id
            );

            this.data.fromSurat = this.fromSurat;
        },

        selectToSuratId(id) {
            this.toSurat = this.toSurats.find((surat) => surat.id == id);

            this.descr = this.descr + this.toSurat.title;

            this.data.toSurat = this.toSurat;

            this.showButton = true;
        },

        reset() {
            this.descr = "";

            this.fromSurat = null;

            this.toSurats = [];

            this.toSurat = null;

            this.data = {};

            this.loading = false;

            this.showButton = false;
        },

        loading: false,

        showButton: false,

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
