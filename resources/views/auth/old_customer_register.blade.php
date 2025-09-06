@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">Customer Register</div>
      <div class="card-body">
        <form method="POST" action="{{ route('customer.register') }}">@csrf
          <div class="mb-3"><input class="form-control" name="name" placeholder="Full Name" required></div>
          <div class="mb-3"><input class="form-control" name="email" placeholder="Email" required></div>
          <div class="mb-3"><input type="password" class="form-control" name="password" placeholder="Password" required></div>
          <div class="mb-3"><input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required></div>
          <button class="btn btn-primary">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
