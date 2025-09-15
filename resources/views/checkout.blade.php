@extends('layouts.nav')

@section('content')
<br>
<br>
<div class="container">
    <div class="checkout-container">
         <!-- Order Summary -->
        <div class="checkout-summary" id="checkout-summary">
            <h3>Order Summary</h3>
            <!-- Items will be populated here -->
            <div id="checkout-items"></div>

            <div class="checkout-total">
                <span>Total</span>
                <span id="checkout-total">₦0.00</span>
            </div>
        </div>

        <!-- Billing Form -->
        <div class="checkout-form">
            <h2 class="section-title">Billing Information</h2>
            <form method="POST" action="{{ route('checkout.place') }}">
                @csrf
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="address">Street Address</label>
                    <textarea id="address" name="address" rows="3" required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" required>
                    </div>

                    <div class="form-group">
                        <label for="zip">Postal Code</label>
                        <input type="text" id="zip" name="zip" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="payment">Payment Method</label>
                    <select id="payment" name="payment" required>
                        <option value="card">Credit/Debit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="money_transfer">Bank Transfer</option>
                        <option value="cod">Cash on Delivery</option>
                    </select>
                </div>

        
                <div id="account-details" style="display:none; margin-top:15px; padding:10px; border:1px solid #ccc; border-radius:5px;">
                    <h4>Bank Transfer / COD Details</h4>
                    <p><strong>Bank Name:</strong> {{ $account_details['bank'] }}</p>
                    <p><strong>Account Name:</strong> {{ $account_details['name'] }}</p>
                    <p><strong>Account Number:</strong> {{ $account_details['number'] }}</p>
                    <p><strong>Amount: <span id="transfer-total">₦0.00</span></strong></p>
                    <small>Please make the payment and keep your transaction reference for confirmation.</small>
                </div>
                   
                <button type="submit" class="place-order-btn">Place Order</button>
            </form>
        </div>
    </div>
</div>




<script>    
    // Show/hide account details based on payment method
    document.getElementById('payment').addEventListener('change', function() {
        const acctDetails = document.getElementById('account-details');
        if (this.value === 'cod' || this.value === 'money_transfer') {
            acctDetails.style.display = 'block';
        } else {
            acctDetails.style.display = 'none';
        }
    });

    document.querySelector('.checkout-form form').addEventListener('submit', function(e) {
        // Grab cart from localStorage
        const cart = JSON.parse(localStorage.getItem('marketplace-cart')) || [];

        // Attach hidden input with cart data
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'cart';
        input.value = JSON.stringify(cart);
        this.appendChild(input);
    });

</script>

@endsection
