@component('mail::message')
# Reset Password

Hello ,

You are receiving this email because you requested for password reset.
Please use the code below to reset your password.

{{ $otp }}

If you did not request for a password change, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
