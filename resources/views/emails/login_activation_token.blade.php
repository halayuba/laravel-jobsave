@component('mail::message')
# Account Activation

Thank you for siging up with Job Save. Please click the link below to verify your email address and to complete your account registration.

@component('mail::button', ['url' => route('auth.activate', [
  'token' => $user->activation_token,
  'email' => $user->email
])])
  Activate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
