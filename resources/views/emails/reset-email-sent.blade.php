<x-mail::message>
# Reset Password

You are receiving this email because you requested for password reset. Please use the link below to reset it.

<x-mail::button :url="$url">
Reset Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
