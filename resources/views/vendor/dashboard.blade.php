@extends('layouts.app')
@section('content')
<h3>Vendor Dashboard</h3>
<p>Welcome, {{ auth()->user()->name }}</p>
<a href="{{ route('vendor.products.index') }}" class="btn btn-sm btn-primary">My Products</a>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    <script>
        // document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        // });
    </script>
@endif

