@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg rounded-3">
                <div class="card-header text-center fw-bold">
                    @if (Route::currentRouteNamed('login.vendor'))
                        {{ __('Login as Vendor') }}
                    @elseif (Route::currentRouteNamed('login.admin'))
                        {{ __('Login as Admin') }}
                    @else
                        {{ __('Login as Customer') }}
                    @endif
                </div>

                <div class="card-body">
                    <form method="POST" action="
                        @if (Route::currentRouteNamed('login.vendor'))
                            {{ route('login.vendor.submit') }}
                        @elseif (Route::currentRouteNamed('login.admin'))
                            {{ route('login.admin.submit') }}
                        @else
                            {{ route('login') }}
                        @endif
                    ">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autofocus>

                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                name="password" required>

                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                @if (Route::currentRouteNamed('login.vendor'))
                                    {{ __('Login as Vendor') }}
                                @elseif (Route::currentRouteNamed('login.admin'))
                                    {{ __('Login as Admin') }}
                                @else
                                    {{ __('Login as Customer') }}
                                @endif
                            </button>
                        </div>

                        <!-- Forgot Password -->
                        <div class="mt-3 text-center">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
