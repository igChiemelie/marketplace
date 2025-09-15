@extends('layouts.vendor')

@section('content')
<div class="content">
    <div class="page-title">
        <h1>My Orders</h1>
    </div>

    <div class="row">
        <!-- Left Column -->
        <div class="col-md-8">
            <!-- Orders -->
            <div class="card mb-20">
                <div class="card-header">
                    <h2>Orders</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>#{{ $order->order_number }}</td>
                                        <td>
                                            @if ($order->payment_method == 'money_transfer')
                                                Money Transfer
                                            @elseif($order->payment_method == 'card') 
                                                Card
                                            @elseif($order->payment_method == 'cod') 
                                                Cash On Transfer
                                            @elseif($order->payment_method == 'paypal') 
                                                Paypal
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge 
                                                @if($order->status == 'pending') badge-warning
                                                @elseif($order->status == 'paid') badge-success
                                                @elseif($order->status == 'failed') badge-danger
                                                @else badge-info @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>₦{{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            
                                            {{ $order->created_at }}
                                        </td>
                                        <td>
                                            <form action="{{ route('customer.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>

                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No orders yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: "{{ $errors->first() }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif
@endsection
