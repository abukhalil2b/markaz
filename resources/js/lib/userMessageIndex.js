export default function (wire) {
    return {
        showReceivedMessages: true,

        messageIds: [],

        loading: false,

        selectMessageId(id) {
            this.messageIds.includes(id)
                ? (this.messageIds = this.messageIds.filter((i) => i != id))
                : this.messageIds.push(id);
        },

        handleDelete() {
            this.loading = true;
            wire.delete(this.messageIds).then((res) => {
                this.loading = false;
                if (res == "success") {
                    this.messageIds = [];
                }
            });
        },
    };
}
