
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketHub - Multi-Vendor Login & Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #577AEF 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 900px;
            overflow: hidden;
            display: flex;
            min-height: 600px;
        }
        
        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #577AEF 0%, #2575fc 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        
        .left-panel h2 {
            margin-bottom: 20px;
            font-size: 28px;
        }
        
        .left-panel p {
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.6;
        }
        
        .left-panel button {
            background-color: transparent;
            border: 2px solid white;
            border-radius: 50px;
            padding: 12px 30px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .left-panel button:hover {
            background-color: white;
            color: #577AEF;
        }
        
        .right-panel {
            flex: 2;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .form-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo h1 {
            color: #333;
            font-size: 32px;
            font-weight: 700;
        }
        
        .logo span {
            color: #577AEF;
        }
        
        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .social-btn {
            flex: 1;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .social-btn:hover {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        
        .social-btn i {
            margin-right: 8px;
            font-size: 18px;
        }
        
        .fb-btn {
            color: #3b5998;
        }
        
        .google-btn {
            color: #DB4437;
        }
        
        .divider {
            text-align: center;
            position: relative;
            margin: 25px 0;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #ddd;
        }
        
        .divider span {
            background: white;
            position: relative;
            padding: 0 15px;
            color: #777;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }
        
        .input-with-icon input, .input-with-icon select {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .input-with-icon input:focus, .input-with-icon select:focus {
            border-color: #577AEF;
            box-shadow: 0 0 0 2px rgba(87, 122, 239, 0.2);
            outline: none;
        }
        
        .user-type-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .user-type-btn {
            flex: 1;
            padding: 12px;
            text-align: center;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .user-type-btn.active {
            border-color: #577AEF;
            background: rgba(87, 122, 239, 0.1);
            color: #577AEF;
        }
        
        .user-type-btn i {
            font-size: 20px;
            margin-bottom: 8px;
            display: block;
        }
        
        .vendor-fields {
            display: none;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .forgot-password {
            display: block;
            text-align: right;
            margin-bottom: 20px;
            color: #577AEF;
            text-decoration: none;
            font-size: 14px;
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
        
        .submit-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #577AEF 0%, #2575fc 100%);
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .submit-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        
        .switch-form {
            text-align: center;
            margin-top: 25px;
            font-size: 15px;
            color: #555;
        }
        
        .switch-form a {
            color: #577AEF;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
        }
        
        .switch-form a:hover {
            text-decoration: underline;
        }
        
        .register-form {
            display: none;
        }
        
        .terms {
            font-size: 14px;
            color: #777;
            margin-top: 20px;
            text-align: center;
        }
        
        .terms a {
            color: #577AEF;
            text-decoration: none;
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                max-width: 450px;
            }
            
            .left-panel {
                padding: 30px;
            }
            
            .right-panel {
                padding: 30px;
            }
            
            .user-type-selector {
                flex-direction: column;
            }
        }
        .invalid-feedback{
            color:red;
        }
    </style>
    
</head>
<body>
    <div class="container">
        
        <div class="left-panel">
            <h2>New to MarketHub?</h2>
            <p>Join our community and enjoy a seamless shopping experience with exclusive deals, personalized recommendations, and faster checkout.</p>
            <button id="switch-to-register">Sign Up</button>
        </div>
        
        <div class="right-panel">
            <div class="form-container">
                <div class="logo">
                    <h1><i class="fas fa-store"></i> Market<span>Hub</span></h1>
                </div>
                
                <!-- Login Form -->
                <form class="login-form" method="POST" action="{{ route('login.vendor.submit') }}">
                        @csrf
                    <div class="social-login">
                        <button type="button" class="social-btn fb-btn">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </button>
                        <button type="button" class="social-btn google-btn">
                            <i class="fab fa-google"></i> Google
                        </button>
                    </div>
                    
                    <div class="divider">
                        <span>Or use your email</span>
                    </div>
                    
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email"  name="email" id="login-email" placeholder="Enter your email" required>
                        </div>
                        @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password"  name="password" id="login-password" placeholder="Enter your password" required>
                        </div>
                        @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                    </div>
                    
                    {{-- <a href="#" class="forgot-password">Forgot Password?</a> --}}
                    {{-- <a href="#" class="forgot-password">Forgot Password?</a> --}}
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    
                    <button type="submit" class="submit-btn">{{ __('Login as Vendor') }}</button>
                    
                    <div class="switch-form">
                        Don't have an account? <a href="/vendor/register">Register Now</a>
                    </div>
                </form>
             
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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


</body>
</html>