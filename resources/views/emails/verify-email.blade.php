@component('mail::message')
# Verify Your Email Address

Hello {{ $user->name }},

Thank you for registering! Please click the button below to verify your email address.

@component('mail::button', ['url' => $url])
Verify Email Address
@endcomponent

This link will expire in {{ config('auth.verification.expire', 60) }} minutes.

If you did not create an account, please ignore this email.

Thanks,
{{ config('app.name') }}
@endcomponent