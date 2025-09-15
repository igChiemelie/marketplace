@extends('layouts.admin')
@section('content')
<!-- Settings Tab -->
<div class="" id="settings">
    <div class="page-title">
        <h1>System Settings</h1>
        <div>Today: <span id="current-date">Monday, Oct 16, 2023</span></div>

    </div>

    

    <div class="card">
        <div class="card-header">
            <h2>Password Settings</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.updatePassword') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="site-name">Site Name</label>
                    <input type="text" class="form-control" id="site-name" readonly value="MarketHub Admin">
                </div>
                <div class="form-group">
                    <label for="admin-email">Admin Email</label>
                    <input type="email" readonly name="email" class="form-control" id="admin-email" value="{{ auth()->user()->email }}">
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" class="form-control" id="phone"  value="{{ old('phone', auth()->user()->phone ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="bank_name">Bank Name</label>
                    <input type="text" name="bank_name" class="form-control" value="{{ old('bank_name', auth()->user()->bank_name ?? '') }}" autocomplete="bank_name">
                </div>

                <div class="form-group">
                    <label for="acct_name">Acct Name</label>
                    <input type="text" name="acct_name" class="form-control" value="{{ old('acct_name', auth()->user()->acct_name ?? '') }}" autocomplete="acct_name" >
                </div>

                <div class="form-group">
                    <label for="acct_no">Acct No.</label>
                    <input type="number" name="acct_no" class="form-control" value="{{ old('acct_no', auth()->user()->acct_no ?? '') }}">
                </div>


                <div class="form-group">
                    <label for="site-url">Password</label>
                    <input type="password" name="current_password" class="form-control" id="site-url" required>
                </div>
                <div class="form-group">
                    <label for="site-url">New Password</label>
                    <input type="password" name="password" class="form-control" id="site-url" required>
                </div>
                <div class="form-group">
                    <label for="admin-email">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="admin-email">
                </div>
               
                <button type="submit" class="btn btn-primary">Update Settings</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                icon: 'error'
            });
        </script>
    @endif

    @if (session('success'))

        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        </script>
    @endif
@endsection