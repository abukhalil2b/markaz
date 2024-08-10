export default function () {
    return {

        show:false,

        answer_content:'',

        loading:false,

        message:'',

        sendAnswer(wire,questionId) {

            if(this.answer_content == '' || questionId == undefined){
                this.message = 'إكتب الإجابة';
                return;
            }

            this.loading = true;

            wire.answer(this.answer_content,questionId)
            .then(res=>{

                this.loading = false;

                this.answer_content = '';

                this.message = '';

                this.show = false;
               
                location.reload();
            })

           

        },
    };
}
