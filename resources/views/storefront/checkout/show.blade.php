@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Checkout</h2>
    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('checkout.place') }}" method="POST">
                @csrf
                <h4>Billing Details</h4>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" name="state" id="state" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="zip">Zip Code</label>
                    <input type="text" name="zip" id="zip" class="form-control" required>
                </div>

                <hr>

                <h4>Payment Information</h4>
                <p>You will be redirected to Paystack to complete your payment.</p>

                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        </div>
        <div class="col-md-4">
            <h4>Order Summary</h4>
            <table class="table">
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->product->name }} x {{ $item->quantity }}</td>
                            <td>{{ $item->product->price * $item->quantity }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>Subtotal</td>
                        <td>{{ $summary['subtotal'] }}</td>
                    </tr>
                    <tr>
                        <td>Tax</td>
                        <td>{{ $summary['tax_total'] }}</td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>{{ $summary['shipping_total'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        <td><strong>{{ $summary['grand_total'] }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
