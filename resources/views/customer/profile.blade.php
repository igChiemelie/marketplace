@extends('layouts.vendor')

@section('content')
    <div class="content">
        <div id="profile">
            <div class="page-title">
                <h1>Manage Profile</h1>
                <div>Today: <span id="current-date">Monday, Oct 16, 2023</span></div>

            </div>

            <!-- Profile Form -->
            <div class="card" style="margin-top:20px;">
                <div class="card-header">
                    <h2>Update Store Information</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name"value="{{ $customer->name }}"
                                class="form-control">
                        </div>



                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $customer->email }}">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ $customer->address }}">
                        </div>

                        <div class="form-group">
                            <label>Photo</label>
                            <input type="file" name="shop_logo" id="logo" class="form-control" accept="image/*">
                            <div id="logo-preview" style="margin-top:10px;">
                                @if ($customer->avatar)
                                    <img src="{{ asset('storage/' . $customer->avatar) }}" alt="Logo" width="300">
                                @else
                                    {{-- <p>Logo not found!</p> --}}
                                @endif
                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>

            {{-- Profile password --}}
            <div class="card" style="margin-top:20px;">
                <div class="card-header">
                    <h2>Change Password</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('customer.password.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="current_password" id="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="name" class="form-control">
                        </div>


                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
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


    <script>
        document.getElementById('logo').addEventListener('change', function(e) {
            let reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('logo-preview').innerHTML =
                    `<img src="${event.target.result}" width="100" style="border-radius:50%;">`;
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        document.getElementById('banner').addEventListener('change', function(e) {
            let reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('banner-preview').innerHTML =
                    `<img src="${event.target.result}" width="300">`;
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>
@endsection
