@extends('layouts.vendor')

@section('content')
<div class="content">
    <div class="page-title">
        <h1>Customer Dashboard</h1>
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
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>#{{ $order->order_number }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($order->status == 'pending') badge-warning
                                                @elseif($order->status == 'paid') badge-success
                                                @elseif($order->status == 'failed') badge-danger
                                                @else badge-info @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
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

        <!-- Right Column -->
        <div class="col-md-4">
            <div class="card mb-20">
                <div class="card-header">
                    <h2>Profile</h2>
                </div>
                <div class="card-body text-center" style="display: flex;place-content: space-around;">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="profile-info mt-20">
                        <h2>{{ auth()->user()->name }}</h2>
                        <p>{{ auth()->user()->email }}</p>
                        <a href="{{ route('customer.profile') }}" class="btn btn-primary btn-sm mt-20">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    @if (session('info'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: "{{ session('info') }}",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                });
            </script>
        @endif

        {{-- Session error --}}
@if (session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: "{{ session('error') }}",
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
