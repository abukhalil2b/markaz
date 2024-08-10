import axios from "axios";

export default function () {
    return {
        storeUrl: null,

        deleteUrl: null,

        mission_id: null,

        missionTasks: [],

        lastMissionTask: {},

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
            this.data = {};

            this.loading = false;

        },

        save() {

            this.loading = true;

            this.data.mission_id = this.mission_id;

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
