@component('mail::message')
# You left items in your cart

Hello {{ $user->name }},

You left these items in your cart:

@foreach($cartItems as $item)
- {{ $item->product->name }} (x{{ $item->quantity }})
@endforeach

@component('mail::button', ['url'=>route('cart.index')])
Complete your purchase
@endcomponent

Thanks,<br>{{ config('app.name') }}
@endcomponent
