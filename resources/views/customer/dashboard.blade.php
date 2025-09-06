@extends('layouts.app')
@section('content')
<h3>Customer Dashboard</h3>
<div class="row">
  <div class="col-md-8">
    <div class="card mb-3"><div class="card-header">Orders</div><div class="card-body">
      <ul class="list-group">
        @forelse($orders as $order)
          <li class="list-group-item">#{{ $order->order_number }} — {{ $order->status }} — {{ number_format($order->total_amount,2) }}</li>
        @empty <li class="list-group-item">No orders yet.</li> @endforelse
      </ul>
    </div></div>
    <div class="card mb-3"><div class="card-header">Wishlist</div><div class="card-body">
      <ul class="list-group">
        @forelse($wishlist as $w) <li class="list-group-item">{{ $w->product->name }}</li> @empty <li class="list-group-item">No items</li> @endforelse
      </ul>
    </div></div>
  </div>
  <div class="col-md-4">
    <div class="card"><div class="card-header">Profile</div><div class="card-body">
      <p>{{ auth()->user()->name }}</p><p>{{ auth()->user()->email }}</p>
      <a href="{{ route('customer.profile') }}" class="btn btn-sm btn-outline-primary">Edit Profile</a>
    </div></div>
  </div>
</div>
@endsection
