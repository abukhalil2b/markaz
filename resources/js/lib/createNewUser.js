export default function (watch, storedWorkperiods, storedLevels) {
    return {
        storedWorkperiods: [],

        storedLevels: [],

        workperiods: [],

        levels: [],

        levelId: "",

        userType: "",

        gender: "",

        workperiodIds: [],

        /* start of user info */
        national_id: "",

        first_name: "",

        second_name: "",

        third_name: "",

        last_name: "",

        phone: "",

        email: "",
        /* end of user info */

        /* user obj */
        user: {},
        /* user obj */

        /* store button */
        showStoreButton: false,

        init() {
            this.storedWorkperiods = JSON.parse(storedWorkperiods);

            this.storedLevels = JSON.parse(storedLevels);

            watch("user", (u) => {
                u.national_id &&
                u.first_name &&
                u.second_name &&
                u.third_name &&
                u.last_name &&
                u.phone &&
                u.email
                    ? (this.showStoreButton = true)
                    : (this.showStoreButton = false);
            });
        },

        selectUserType(type) {
            //reset workperiodIds
            this.workperiodIds = [];

            this.userType = type;
            // console.log(this.workperiods);
            if (type == "male_moderator" || type == "male_teacher") {
                this.gender = "m";

                this.workperiods = this.storedWorkperiods.filter(
                    (w) => w.gender == "m"
                );
            }

            if (type == "female_moderator" || type == "female_teacher") {
                this.gender = "f";

                this.workperiods = this.storedWorkperiods.filter(
                    (w) => w.gender == "f"
                );
            }
        },

        selectWorkperiodIds(workperiodId) {
            this.workperiodIds.includes(workperiodId)
                ? (this.workperiodIds = this.workperiodIds.filter(
                      (i) => i != workperiodId
                  ))
                : (this.workperiodIds = [...this.workperiodIds, workperiodId]);

            this.levels = this.storedLevels.filter((l) =>
                this.workperiodIds.includes(l.workperiod_id)
            );
        },

        reset() {
            this.workperiodIds = [];
            this.user = {};
            this.userType = "";
        },
    };
}
