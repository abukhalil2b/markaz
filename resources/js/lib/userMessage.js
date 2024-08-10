export default function (users) {
    return {
        content:'',
        
        users: [],

        init() {
            this.users = users.map((user) => {
                return {
                    id: user.id,
                    name: user.full_name,
                    userType: user.user_type,
                    selected: false,
                };
            });
        },

        select(id) {
            this.users = this.users.map((user) => {
                if (user.id == id) {
                    return {
                        id: user.id,
                        name: user.name,
                        userType: user.userType,
                        selected: !user.selected,
                    };
                } else {
                    return user;
                }
            });
        },

        selectByUserType(userType) {
            this.users = this.users.map((user) => {
                if (user.userType == userType) {
                    return {
                        id: user.id,
                        name: user.name,
                        userType: user.userType,
                        selected: !user.selected,
                    };
                } else {
                    return user;
                }
            });
        },

        selectedBtns: [],

        toggleBtnStyle(btn) {
            this.selectedBtns.includes(btn)
                ? (this.selectedBtns = this.selectedBtns.filter(
                      (e) => e != btn
                  ))
                : this.selectedBtns.push(btn);
        },

        getSelectedUserIds() {
            return this.users.filter((u) => u.selected).map((u) => u.id);
        },

        loading: false,

        handleStore() {
            var receiverIds = this.getSelectedUserIds();

            // wire.set("receiverIds", receiverIds);

            // wire.store().then((res) => {
            //     this.loading = false;
            // });
        },
    };
}
