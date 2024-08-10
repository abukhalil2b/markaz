import axios from "axios";

export default function () {
    return {
        storeUrl: null,

        deleteUrl: null,

        missionType: "new",
        
        selectType:'duaa',

        mission_id: null,

        missionTasks: [],

        lastMissionTask: {},

        descr: "",

        allow_wrong: 1,

        showOrderOptions: false,

        data: {},

        loading: false,

        /*--- in order to change task order ---*/
        selectLastMissionTask(id) {
            this.lastMissionTask = this.missionTasks.find((mt) => mt.id == id);

            this.showOrderOptions = false;

            this.data.selectedMissionTaskOrder =
                this.lastMissionTask.task_order;
        },

        reset() {
            this.descr = "";

            this.data = {};

            this.loading = false;

            this.allow_wrong = 1;
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
            if(this.descr == '' || this.descr == null)
            {
                return;
            }
            this.loading = true;

            this.data.descr = this.descr;

            this.data.selectType = this.selectType;

            this.data.mission_type = this.missionType;

            this.data.mission_id = this.mission_id;

            this.data.allow_wrong = this.allow_wrong;

            axios
                .post(this.storeUrl, this.data)
                .then((res) => {
                    // console.log(res.data)
                    this.missionTasks = res.data;

                    this.lastMissionTask = this.missionTasks[0];

                    this.loading = false;

                    this.reset();
                })
                .catch((e) => {
                    console.log(e);
                });
        },

        Delete(id) {
            this.loading = true;
            axios
                .post(this.deleteUrl, { id: id, mission_id: this.mission_id })
                .then((res) => {
                    this.missionTasks = res.data;

                    this.lastMissionTask = this.missionTasks[0];

                    this.loading = false;
                    
                    this.reset();
                })
                .catch((e) => {
                    return console.log(e);
                });
        },
    };
}
