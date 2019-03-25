<template>
    <div>
        <div id="upload" class="w-3/4 mx-auto mb-3">
            <div id="file-uploader"></div>
        </div>
    </div>
</template>

<script>
   import Uppy from '@uppy/core';
   import Dashboard from '@uppy/dashboard';
   import XHRUpload from '@uppy/xhr-upload';
   import axios from 'axios';

    export default {
        data() {
            return {
                uppy: null,
                articles: []
            }
        },
        mounted() {
            let csrf = document.getElementById('csrf').getAttribute('content');

            const uppy = Uppy({
                restrictions: {
                    allowMultipleUploads: false,
                    maxNumberOfFiles: 3,
                    minNumberOfFiles: 1,
                    target: '#file-uploader',
                    // allowedFileTypes: [
                    //     // 'application/msword',
                    //     // 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    // ],
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
            }).use(Dashboard, {
                id: 'file-uploader',
                disableStatusBar: false,
                target: '#upload',
                inline: true,
                width: '100%',
                height: 450,
                showLinkToFileUploadResult: false,
                showProgressDetails: false,
                hideRetryButton: true,
                hidePauseResumeButton: true,
                hideCancelButton:true,
                hideProgressAfterFinish: false,
                proudlyDisplayPoweredByUppy:false,
                replaceTargetContent: true,

                locale: {
                    strings: {
                        addingMoreFiles: 'اضافه نمودن فایل‌های بیشتر',
                        complete: 'عملیات بارگذاری تکمیل شد',
                        uploadError: 'خطا در آپلود',
                        dropPaste: 'فایل‌های خود را به داخل کادر کشیده و یا با کلیک روی %{browse} آن‌ها را ' +
                            'بارگذاری کنید.',
                        dropPasteImport: 'فایل‌های خود را به داخل کادر کشیده و یا با کلیک روی %{browse} آن‌ها را ' +
                             'بارگذاری کنید.',
                        browse: 'انتخاب فایل',
                        addMoreFiles: 'اضافه نمودن فایل',
                        dashboardTitle: 'داشبورد آپلود فایل',
                        copyLinkToClipboardSuccess: 'لینک در کلیپ‌ بورد ذخیره شد',
                        copyLinkToClipboardFallback: 'آدرس زیر را کپی کنید',
                        copyLink: 'لینک را کپی کنید',
                        done: 'انجام شد',
                        removeFile: 'حذف فایل',
                        editFile: 'ویرایش فایل',
                        editing: 'ویرایش %{file}',
                        edit: 'ویرایش',
                        finishEditingFile: 'اتمام ویرایش فایل',
                        uploadComplete: 'آپلود فایل با موفقیت به اتمام رسید',
                        resumeUpload: 'ادامه‌',
                        pauseUpload: 'توقف',
                        retryUpload: 'بارگذاری مجدد',
                        xFilesSelected: {
                            0: '%{smart_count} فایل انتخاب شد',
                            1: '%{smart_count} فایل انتخاب شد',
                        },
                        cancel: 'لغو عملیات',
                        uploading: 'در حال بارگذاری',
                        uploadFailed: 'عملیات بارگذاری انجام نشد!',
                        pleasePressRetry: 'لطفا روی گزینه آپلود مجدد کلیک کنید.',
                        paused: 'موقتا متوقف شد',
                        error: 'خطا',
                        retry: 'تلاش مجدد',
                        cancel: 'لفو',
                        retryUpload: 'دوباره آپلود کن',
                        pauseUpload: 'عملیات آپلود موقتا متوقف شد',
                        resumeUpload: 'ادامه‌ی آپلود',
                        cancelUpload: 'لفو آپلود',
                        back: 'بازگشت',
                        uploadXFiles: {
                            0: 'آپلود فایل',
                            1: 'آپلود فایل‌ها'
                        }
                    }
                }
            }).use(XHRUpload, {
                endpoint: '/api/documents',
                bundle: true,
                fieldName: 'articles[]',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                getResponseError(responseText, xhr) {
                  return new Error(responseText) ;
                }
            });

            this.uppy = uppy;

            uppy.on('upload-success', (file, body) => {
                console.log(body);
            });

            // uppy.on('upload-error', (file, error, response) => {
            //     console.log(error)  ;
            // });
        },
    }
</script>