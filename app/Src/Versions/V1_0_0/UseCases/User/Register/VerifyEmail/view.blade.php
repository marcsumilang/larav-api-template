@component('mail::message')

Please click the button to verify your email.

@component('mail::button', ['url' => url('/')])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent