@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            @if (session('error'))
                <div class="alert alert-success" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="card-header">Vendor Application</div>
            <div class="card-body">
                <form method="POST" action="{{ route('vendor.register') }}">@csrf
                    <div class="mb-3"><input class="form-control" name="name" placeholder="Full Name" required></div>
                    <div class="mb-3"><input class="form-control" name="email" placeholder="Email" required></div>
                    <div class="mb-3"><input class="form-control" name="shop_name" placeholder="Shop Name" required>
                    </div>
                    <div class="mb-3"><input type="password" class="form-control" name="password" placeholder="Password"
                            required>
                    </div>
                    <div class="mb-3"><input type="password" class="form-control" name="password_confirmation"
                            placeholder="Confirm" required></div>
                    <button class="btn btn-primary">Apply</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


