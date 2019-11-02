@component('mail::message')
    #{{ $comment->name }} - <{{ $comment->email }}>

    {{ $comment->message }}
@endcomponent
