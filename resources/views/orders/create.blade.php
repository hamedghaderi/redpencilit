@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="upload-levels">
            <h3 class="upload-levels__title">آپلود مستندات</h3>

            <ul class="upload-levels__list">
                <li class="upload-levels__item upload-levels__item--active">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۱</span>
                        آپلود مستندات
                    </div>
                </li>
                <li class="upload-levels__item">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۲</span>
                        ثبت نام
                    </div>
                </li>
                <li class="upload-levels__item">
                    <span class="upload-levels__marker"></span>

                    <div class="upload-levels__content">
                        <span>مرحله ۳</span>
                        نهایی کردن اطلاعات
                    </div>
                </li>
            </ul>
        </div><!-- upload-levels -->


        <div id="upload" class="w-3/4 mx-auto">
            <div id="file-uploader"></div>
        </div>
    </div><!-- container -->
@endsection

@section('script')
    <script>
        const uppy = Uppy({
            allowMultipleUploads: true,
            restrictions: {
                maxNumberOfFiles: 3,
                minNumberOfFiles: 1,
                target: '#file-uploader',
                allowedFileTypes: ['.doc', '.docx']
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
            target: '#upload',
            inline: true,
            width: '100%',
            height: 450,
            showLinkToFileUploadResult: false,
            showProgressDetails: true,
            hideUploadButton: true,
            hideRetryButton: true,
            hidePauseResumeButton: true,
            hideCancelButton:true,
            hideProgressAfterFinish: true,
            proudlyDisplayPoweredByUppy:false,
            locale: {
                strings: {
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

                }
            }

        }).use(XHRUpload, { endpoint: 'index.php' });

    </script>
@endsection