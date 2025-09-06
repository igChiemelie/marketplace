@component('mail::message')
# Welcome to {{ config('app.name') }}!

Hello {{ $name }},

We're excited to have you on board! Your account has been created successfully.

Please verify your email address by checking the verification email we sent you. This is required to access all features of your account.

If you have any questions, feel free to contact our support team.

Thanks,
{{ config('app.name') }}
@endcomponent