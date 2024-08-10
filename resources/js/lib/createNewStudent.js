export default function (watch, wire) {
    return {
        workperiodsWithLevels: [],

        workperiods: [],

        levels: [],

        first_name: "",

        second_name: "",

        third_name: "",

        last_name: "",

        /* end of student info */

        /* student obj */
        student: {},
        /* student obj */

        /* loading state */
        loading: false,

        /* store button */
        showStoreButton: false,

        saved: false,

        init() {
            wire.getWorkperiodsWithLevels().then((result) => {
                this.workperiodsWithLevels = JSON.parse(result);
            });

            watch("student", (u) => {
                u.first_name && u.second_name && u.third_name && u.last_name
                    ? (this.showStoreButton = true)
                    : (this.showStoreButton = false);
            });
        },


        selectWorkperiodId(id) {
            //reset level id
            this.student.level_id = "";

            this.student.workperiod_id = id;

            let level = this.workperiodsWithLevels.find((w) => w.id == id);

            this.student.gender = level.gender;

            //fill levels array
            this.levels = level.level_has_workperiods;
        },

        selectLevelId(id) {

            this.student.level_id = id;
        },

        store(wire) {
            this.loading = true;

            console.log(this.student);

            wire.store(this.student).then((result) => {

                this.loading = false;

                result == "success"
                    ? (this.saved = true)
                    : (this.saved = false);
            });
        },

        reset() {
            this.workperiods = [];

            this.levels = [];

            this.student = {};

            this.saved = false;
        },
    };
}
