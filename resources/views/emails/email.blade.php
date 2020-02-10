@component('mail::message')
{{ $user->name  }},

{{ __('To activate your Redpencilit account, please verify your email address. You can not use the website until your email address is confirmed.') }}

@component('mail::button', ['url' => url(app()->getLocale() . '/register/emails?token=' . $user->confirmation_token)])
   {{ __('Confirm Your Email') }}
@endcomponent

@endcomponent
