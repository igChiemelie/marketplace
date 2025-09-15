@extends('layouts.nav')

@section('content')
<div class="container">
    <div class="confirmation-card">
        <h1 class="confirmation-title">✅ Order Placed Successfully!</h1>
        <p class="confirmation-text">Thank you for your order.</p>

        {{-- Show payment method if needed --}}
        {{-- 
        @if(session('payment_method'))
            <p class="confirmation-text">
                <strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', session('payment_method'))) }}
            </p>
        @endif 
        --}}

        @if(session('account_details'))
            <div id="account-details" class="account-details">
                <h4>Bank Transfer / COD Details</h4>
                <p><strong>Bank Name:</strong> {{ session('account_details.bank') }}</p>
                <p><strong>Account Name:</strong> {{ session('account_details.name') }}</p>
                <p><strong>Account Number:</strong> {{ session('account_details.number') }}</p>
                <p><strong>Amount:</strong> ₦{{ number_format(session('account_details.amount'), 2) }}</p>
                <small>Please make the payment and keep your transaction reference for confirmation.</small>
            </div>
        @endif

        <a href="{{ url('/') }}" class="checkout-btn">Return to Home</a>
    </div>
</div>

@if(session('success'))
    <script>
        // optional: auto-show account details if payment method is transfer
        document.addEventListener("DOMContentLoaded", function() {
            let details = document.getElementById("account-details");
            if (details) {
                details.style.display = "block";
            }
        });

        localStorage.removeItem('marketplace-cart');

    </script>
@endif

@if(session('success')) <script> // alert("{{ session('success') }}"); // Clear cart when order is successfully placed // localStorage.removeItem('marketplace-cart'); </script> @endif

<style>
.confirmation-card {
    background: var(--light);
    border-radius: 15px;
    padding: 40px;
    margin: 50px auto;
    max-width: 650px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    text-align: center;
}

body.dark-mode .confirmation-card {
    background: var(--card-dark);
}

.confirmation-title {
    font-size: 28px;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 15px;
}

.confirmation-text {
    font-size: 16px;
    color: var(--gray);
    margin-bottom: 20px;
}

.account-details {
    text-align: left;
    margin: 20px 0;
    padding: 20px;
    border: 1px solid #eee;
    border-radius: 12px;
    background: #fafafa;
}

body.dark-mode .account-details {
    background: var(--card-dark);
    border-color: #333;
}
</style>
@endsection
