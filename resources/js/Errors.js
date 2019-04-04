class Errors {
    constructor() {
       this.errors = {};
    }

    record(errors) {
        this.errors = errors;
    }

    has(key) {
        return this.errors.hasOwnProperty(key);
    }

    get(field) {
       if (this.errors[field]) {
           return this.errors[field][0];
       }
    }
}

export default Errors;