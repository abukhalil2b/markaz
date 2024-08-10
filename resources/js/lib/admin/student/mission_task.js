import axios from "axios";

export default function () {
    return {
        storeUrl: null,

        showRedirectUrl: false,

        missionId: null,

        studentId: null,

        loading: false,

        saved: false,

        savedMessage: "",

        save() {
            this.loading = true;

            if (this.missionId == null || this.studentId == null) {
                return;
            }
            axios
                .post(this.storeUrl, {
                    missionId: this.missionId,
                    studentId: this.studentId,
                })
                .then((res) => {
                    this.loading = false;

                    this.saved = true;

                    this.savedMessage = "تم إضافة المهمة";

                    this.showRedirectUrl = true;

                    console.log(res.data);
                })
                .catch((e) => {});
        },
    };
}
