@component('mail::message')
# New Order Notification

Hello {{ $vendor->name }},

You have a new order for your product:

- **Product ID:** {{ $orderItem->product_id }}
- **Quantity:** {{ $orderItem->quantity }}
- **Total:** ₦{{ number_format($orderItem->total, 2) }}

**Customer Details**
- Name: {{ $order->fullname }}
- Email: {{ $order->email }}
- Phone: {{ $order->phone }}

@component('mail::button', ['url' => url('/vendor/orders/'.$order->id)])
View Order
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent
