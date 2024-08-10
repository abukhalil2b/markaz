import moment from 'moment';

export default function timeComponent() {
    return {
        time: new Date(),
        init() {
          setInterval(() => {
            this.time = new Date();
          }, 1000);
        },
        getTime() {
            return moment(this.time).format('h:mm:ss A')
        },
    }
} 