@if(app()->getLocale() === 'fa')
    <style>
        body,
        body *:not(html):not(style):not(br):not(tr):not(code){
            direction: rtl!important;
            font-family: Tahoma, sans-serif!important;
        }

        p,
        ul,
        ol,
        blockquote {
            text-align: right!important;
        }

        h1 {
            text-align: right!important;
        }

        h2 {
            text-align: right!important;
        }

        h3 {
            text-align: right!important;
        }

        p {
            text-align: right!important;
        }
    </style>
@endif

@component('mail::message')
    #{{ $comment->name }} - <{{ $comment->email }}>

    {{ $comment->message }}
@endcomponent
