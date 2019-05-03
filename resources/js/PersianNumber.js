export default class PersianNumber {
    constructor() {
        this._persian = { 0: '۰', 1: '۱', 2: '۲', 3: '۳', 4: '۴', 5: '۵', 6: '۶', 7: '۷', 8: '۸', 9: '۹' };
    }

    toPersian(str) {
        let self = this;

       let newStr = String(str).replace(/\d/gi, function (match, pos, text) {
            return self._persian[match];
       });

       return newStr;
    }
}

