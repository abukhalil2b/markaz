export default function (questions) {
    return {
        init() {
            console.log(questions);
        },
        selected(option) {
            return true;
        },
    };
}
