@component('mail::message')
<h5>Hello!</h5>
You are receiving this email because we received a password reset request for your account.
@component('mail::button', ['url' => $resetPasswordLink])
    Reset Password
@endcomponent
This password reset link will expire in 60 minutes.
If you did not request a password reset, no further action is required.

Regards,<br>
{{ config('app.name') }}

<hr>
If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <a href="{{$resetPasswordLink}}">{{$resetPasswordLink}}</a>
@endcomponent

