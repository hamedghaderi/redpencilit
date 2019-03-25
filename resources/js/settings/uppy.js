let uppy_settings = {
    restrictions: {
        allowMultipleUploads: false,
        maxNumberOfFiles: 3,
        minNumberOfFiles: 1,
        target: '#file-uploader',
        allowedFileTypes: [
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ],
    },

    locale: {
        strings: {
            youCanOnlyUploadFileTypes: 'فرمت‌های مجاز:',
            youCanOnlyUploadX: {
                0: 'حداکثر تعداد فایل‌های مجاز: ‌%{smart_count} فایل',
                1: 'حداکثر تعداد فایل‌های مجاز: ‌%{smart_count} فایل'
            },
            youHaveToAtLeastSelectX: {
                0: 'هیچ فایلی آپلود نشده است.',
                1: 'هیچ فایلی آپلود نشده است.'
            },
        }
    }
};

export {uppy_settings};