@component('mail::message')
# Hello {{ $vendor->shop_name }}

Thanks for applying as a vendor. Your application has been received and will be reviewed by our team.

@component('mail::button', ['url'=>route('vendor.registration.success')])
View Application
@endcomponent

Thanks,<br>{{ config('app.name') }}
@endcomponent
