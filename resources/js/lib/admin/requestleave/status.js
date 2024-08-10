export default function () {
    return {

        status: "new",

        setNew() {
            this.status = "new";
        },

        setApproved() {
            this.status = "approved";
        },

        setRejected() {
            this.status = "rejected";
        },

    };
}
