import axios from "axios";


export default function () {
    return {
        url:null,

        mission_id:null,

        missionTasks:[],

        quran_ayas:[],

        missionSurats: [],

        selectType: null, //ayaToAya - suratToSurat - oneSurat

        oneSurats: [], //oneSurats

        oneSurat: null,

        fromSurats: [], //fromSurats

        fromSurat: null,

        toSurats: [], //toSurats

        toSurat: null,

        fromSuratAyas:[],

        fromAya: null,

        toSuratAyas:[],

        toAya: null,

        note: "",

        data: {},

        selectOneSurat() {
            this.reset();
            this.oneSurats = this.missionSurats;

            this.selectType = "oneSurat";

            this.data.selectType = "oneSurat";

        },

        selectOneSuratId(id) {
            this.oneSurat = this.oneSurats.find((surat) => surat.id == id);

            this.note = "سورة" + this.oneSurat.title + " كاملة";

            this.data.oneSurat = this.oneSurat;

            this.showButton=true;
        },

        selectSuratToSurat() {
            this.reset();

            this.fromSurats = this.missionSurats;

            this.selectType = "suratToSurat";

            this.data.selectType = "suratToSurat";
        },

        selectFromSuratId(id) {
            this.fromSurat = this.fromSurats.find((surat) => surat.id == id);

            this.toSurats = this.missionSurats.filter((surat) => surat.id > id);

            this.note = "من سورة" + this.fromSurat.title + " ";

            this.data.fromSurat = this.fromSurat;
        },

        selectToSuratId(id) {
            this.toSurat = this.toSurats.find((surat) => surat.id == id);

            this.fromSurats = [];

            this.toSurats = [];

            this.note =
                this.note + "إلى سورة" + this.toSurat.title + " ";

            this.data.toSurat = this.toSurat;

            this.showButton=true;
        },

        selectAyaToAya() {
            this.reset();

            this.fromSurats = this.missionSurats;

            this.selectType = "ayaToAya";

            this.data.selectType = "ayaToAya";
        },

        selectFromSuratIdToGetAyas(id) {
            this.fromSurat = this.fromSurats.find((surat) => surat.id == id);

            this.fromSuratAyas = this.quran_ayas.filter((aya) => aya.quran_surat_id == this.fromSurat.id);

            this.fromSurats = [];

            this.toSurats = this.missionSurats;

            this.note = "من سورة" + this.fromSurat.title + " ";

            this.data.fromSurat = this.fromSurat;
        },

        selectToSuratIdToGetAyas(id) {
            this.showButton=true;
            console.log(id)
            console.log(this.fromSurat)
        },

        reset() {
            this.selectType = null;

            this.note = "";

            this.oneSurats = [];

            this.fromSurats = [];

            this.toSurats = [];

            this.oneSurat = null;

            this.data = {};

            this.loading=false;
        
            this.showButton=false;
        },

        loading:false,

        showButton:false,
        
        save() {
            this.loading = true;

            this.data.note = this.note;

            this.data.mission_id = this.mission_id;

            axios.post(this.url,this.data)
            .then(res=>{
                this.missionTasks = res.data;
                this.loading = false;
            }).catch(e=>{
                console.log(e)
            })

        },
    };
}
