<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst(config('app.name')) }} - Multi-Vendor E-Commerce</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- <link rel="stylesheet" href="../custom/css/style.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('custom/css/style.css') }}"> --}}

    @vite(['resources/custom/css/style.css', 'resources/custom/js/script.js'])
</head>

<body>

    <!-- Header Section -->
    <header>
        <div class="container">
            <div class="header-top">
                <a href="/" class="logo" id="home-link"><i
                        class="fas fa-store"></i>{{ substr(config('app.name'), 0, 5) }}<span>{{ substr(config('app.name'), 5, 9) }}</span></a>

                <div class="search-bar">
                    <input type="text" id="search-input" placeholder="Search for products, brands and categories...">
                    <button id="search-button"><i class="fas fa-search"></i></button>
                </div>

                <div class="header-actions">
                    @if (Auth::check() && Auth::user()->role == 'vendor')
                        <div class="header-action-item">
                            <i class="fas fa-user"></i>
                            <a href="/vendor/dashboard">Dashboard</a>
                        </div>
                    @elseif(Auth::check() && Auth::user()->role == 'admin')
                        <div class="header-action-item">
                            <i class="fas fa-user-shield"></i>
                            <a href="/admin/dashboard">Admin Panel</a>
                        </div>
                    @elseif (Auth::check() && Auth::user()->role == 'customer')
                        {{-- <div class="header-action-item">
                            <i class="fas fa-user"></i>
                            <a href="/customer/dashboard">My Account</a>
                        </div> --}}
                        
                        <div class="header-action-item account-dropdown">
                            <i class="fas fa-user"></i>
                            <span>My Account</span>

                            <div class="dropdown-menu">
                                <a href="/customer/profile"><i class="fas fa-user-circle"></i> Profile</a>
                                {{-- <a href="/customer/address"><i class="fas fa-map-marker-alt"></i> Address</a> --}}
                                <a href="/customer/orders"><i class="fas fa-box"></i> Orders</a>
                                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                                    @csrf
                                    <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="header-action-item">
                            <i class="fas fa-user"></i>
                            <a href="/login">Account</a>
                        </div>
                    @endif




                    <div class="cart-preview header-action-item" style="position: relative;">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Cart</span>
                        <span class="cart-count">0</span>
                        <div class="container">


                        <div class="cart-dropdown" id="cart-dropdown">
                            <div class="empty-cart-message">
                                <i class="fas fa-shopping-cart"></i>
                                <p>Your cart is empty</p>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>

            <nav>
                <ul class="nav-menu">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ url('/category/' . $category->slug) }}">
                                {{ ucfirst($category->name) }}
                            </a>
                        </li>
                    @endforeach
                    <li><a href="{{ url('/vendors') }}">Vendors</a></li>
                </ul>
            </nav>
        </div>
    </header>


    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>
                       {{ substr(config('app.name'), 0, 5) }}{{ substr(config('app.name'), 5, 9) }}</a>

                    </h3>
                    <p>The ultimate multi-vendor e-commerce platform for buyers and sellers.</p>
                    <div class="footer-social">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Shopping</h3>
                    <ul class="footer-links">
                        <li><a href="#" data-page="electronics">Electronics</a></li>
                        <li><a href="#" data-page="fashion">Fashion</a></li>
                        <li><a href="#" data-page="beauty">Beauty</a></li>
                        <li><a href="#" data-page="sports">Sports</a></li>
                        <li><a href="#" data-page="vendors">Vendors</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Vendors</h3>
                    <ul class="footer-links">
                        <li><a href="#">Become a Vendor</a></li>
                        <li><a href="#">Vendor Dashboard</a></li>
                        <li><a href="#">Vendor Guidelines</a></li>
                        <li><a href="#">Top Vendors</a></li>
                        <li><a href="#">Seller FAQ</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Support</h3>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Shipping Info</a></li>
                        <li><a href="#">Returns & Refunds</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{config('app.name')}}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Product Modal -->
    <div class="modal" id="productModal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div id="modal-product-content">
                <!-- Content will be loaded by JavaScript -->
            </div>
        </div>
    </div>

</body>

</html>
