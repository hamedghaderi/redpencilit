export default class Event {
    constructor(vue) {
        this.vue = vue;
    }

    fire(event, args) {
        this.vue.$emit(event, args);
    }

    listen(event, callback) {
        this.vue.$on(event, callback);
    }
}
