@extends('layouts.vendor')

@section('content')
    <div class="content">
        <div id="profile">
            <div class="page-title">
                <h1>Manage Profile</h1>
                <div>Today: <span id="current-date">Monday, Oct 16, 2023</span></div>

            </div>

            <!-- Profile Header -->
            <div class="profile-header">
                <!-- Banner -->
                {{-- @if ($vendor->shop_banner)
                    <img src="{{ asset('storage/' .$vendor->shop_banner) }}" alt="Banner" class="profile-banner"
                        style="width:100%; height:200px; object-fit:cover; border-radius:8px;">
                @endif --}}

                <!-- Avatar / Logo -->
                <div class="profile-avatar" style="margin-top:-50px;">
                    @if ($vendor->shop_logo)
                        <img src="{{ asset('storage/'.$vendor->shop_logo) }}" alt="Logo" class="logo-img"
                            style="width:100px; height:100px; border-radius:50%; border:3px solid #fff;">
                    @else
                        <div
                            style="width:100px; height:100px; border-radius:50%; background:#ccc; display:flex; align-items:center; justify-content:center; font-weight:bold;">
                            {{ strtoupper(substr($vendor->shop_name, 0, 2)) }}
                        </div>
                    @endif
                </div>

                <div class="profile-info" style="margin-top:10px;">
                    <h2>{{ $vendor->shop_name }}</h2>
                    <p>{{ $vendor->shop_description }}</p>

                    <!-- User Info -->
                    <p><strong>Email:</strong> {{ $vendor->user->email }}</p>
                    <p><strong>Phone:</strong> {{ $vendor->user->phone ?? 'Not set' }}</p>
                </div>
            </div>

            <!-- Profile Form -->
            <div class="card" style="margin-top:20px;">
                <div class="card-header">
                    <h2>Update Store Information</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('vendor.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="shop_name">Shop Name</label>
                            <input type="text" name="shop_name" class="form-control" value="{{ $vendor->shop_name }}">
                        </div>

                        <div class="form-group">
                            <label for="shop_description">Shop Description</label>
                            <textarea name="shop_description" class="form-control">{{ $vendor->shop_description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $vendor->user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $vendor->user->phone }}">
                        </div>

                        <div class="form-group">
                            <label>Shop Logo</label>
                            <input type="file" name="shop_logo" id="logo" class="form-control" accept="image/*">
                            <div id="logo-preview" style="margin-top:10px;">
                               @if($vendor->shop_logo)
                                    <img src="{{ asset('storage/'.$vendor->shop_logo) }}" alt="Logo" width="300">
                                @else
                                    <p>Logo not found!</p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Shop Banner</label>
                            <input type="file" name="shop_banner" id="banner" class="form-control" accept="image/*">
                            <div id="banner-preview" style="margin-top:10px;">
                                {{-- @if($vendor->shop_banner)
                                    <img src="{{ asset('storage/'.$vendor->shop_banner) }}" width="300">
                                @endif --}}
                                @if($vendor->shop_banner)
                                    <img src="{{ asset('storage/'.$vendor->shop_banner) }}" alt="Logo" width="300">
                                @else
                                    <p>Logo not found!</p>
                                @endif
                            </div>
                        </div>
                     
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
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
<script>
    document.getElementById('logo').addEventListener('change', function(e){
        let reader = new FileReader();
        reader.onload = function(event){
            document.getElementById('logo-preview').innerHTML = `<img src="${event.target.result}" width="100" style="border-radius:50%;">`;
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    document.getElementById('banner').addEventListener('change', function(e){
        let reader = new FileReader();
        reader.onload = function(event){
            document.getElementById('banner-preview').innerHTML = `<img src="${event.target.result}" width="300">`;
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endsection
