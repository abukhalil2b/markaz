export default function (studentHasRecordDailys,url) {
    return {
        init(){
            console.log(studentHasRecordDailys);
            this.studentHasRecordDailys = studentHasRecordDailys;
            this.url = url;
        },
        studentHasRecordDailys:[],
        loading: false,
        url: '',
        updateAttendance(id) {
            this.loading = true;

            window.axios.post(url,{id})
            .then(result => {
               this.studentHasRecordDailys = this.studentHasRecordDailys.map(r=>{
                    if(r.id == result.data.id){
                        r.present = result.data.present
                    }
                    return r;
                })
                this.loading = false;
                console.log(result.data)
            })
            .catch(error => console.log(error))
            
        },
    };
}
