import moment from "moment";
export default function (wire, students) {
    return {
        students: [],

        selectedIds: [],

        loading: false,

        init() {
            this.students = this.mappedStudents(students);
        },

        selectId(id) {
            this.selectedIds.includes(id)
                ? (this.selectedIds = this.selectedIds.filter((e) => e != id))
                : this.selectedIds.push(id);
        },

        activeStudent() {

            if (this.selectedIds.length == 0) {

                alert("حدد الطلاب");

                return;
            }

            this.loading = true;
            
            wire.update(JSON.stringify(this.selectedIds)).then((resutl) => {
                this.students = this.mappedStudents(JSON.parse(resutl));

                this.selectedIds = [];

                this.loading = false;
            });
        },

        mappedStudents(students) {

            return students.map((s) => {

                return {
                    id: s.id,
                    name: s.full_name,
                    workperiodTitle: s.workperiod.title,
                    createdAt: moment(s.created_at).format("d-m-Y"),
                    days: moment(s.created_at).locale("ar").fromNow(),
                };

            });
        },
    };
}
