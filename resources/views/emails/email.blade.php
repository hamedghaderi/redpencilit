@component('mail::message')
# آخرین مرحله‌ی تائید هویت

جهت افزایش امنیت از شما خواهشمندیم که ایمیلتان را تائید کنید.

@component('mail::button', ['url' => url('/register/emails?token=' . $user->confirmation_token)])
    تائید ایمیل
@endcomponent

با تشکر<br>
{{ config('app.name') }}
@endcomponent
