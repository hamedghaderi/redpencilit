const Persian = require('@uppy/locales/lib/fa_IR');
Persian.strings.youCanOnlyUploadFileTypes = 'فرمت‌ فایل صحیح نیست. لطفا از فرمت docx استفاده کنید.';

let uppy_settings = {
    restrictions: {
        allowMultipleUploads: false,
        maxNumberOfFiles: 4,
        minNumberOfFiles: 1,
        target: '#file-uploader',
        allowedFileTypes: [
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ],
    },

    locale: Persian
};

export {uppy_settings};