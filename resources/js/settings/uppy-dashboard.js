const Persian = require('@uppy/locales/lib/fa_IR');
Persian.strings.dropPaste =  'فایلها را اینجا رها کنید، یا  %{browse} بارگذاری کنید.';

let dashboard_settings = {
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

    locale: Persian
};

export {dashboard_settings};
