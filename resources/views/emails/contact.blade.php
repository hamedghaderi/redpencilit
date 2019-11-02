@component('mail::message')
# {{ $comment->name }}

{{ $comment->message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
