const Persian = require('@uppy/locales/lib/fa_IR');
const US = require('@uppy/locales/lib/en_US');
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
};

export {dashboard_settings, Persian, US};
