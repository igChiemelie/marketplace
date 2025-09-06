@component('mail::message')
# New Order Received

Hello {{ $vendor->shop_name }},

You have a new order with these items:

@foreach($orderItems as $item)
- {{ $item->product->name }} (x{{ $item->quantity }}) — ${{ number_format($item->total,2) }}
@endforeach

@component('mail::button', ['url'=>route('vendor.dashboard')])
View Orders
@endcomponent

Thanks,<br>{{ config('app.name') }}
@endcomponent
