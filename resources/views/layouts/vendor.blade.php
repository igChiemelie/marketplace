<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst(config('app.name')) }} - Vendor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- <link rel="stylesheet" href="css/style.css"> --}}
    @vite(['resources/custom/css/styles.css', 'resources/custom/js/script2.js'])
    <style>
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
        }

        .badge i {
            margin-right: 6px;
        }

        /* Verified */
        .badge.verified {
            background: #2ecc71;
            color: #fff;
        }

        /* Unverified */
        .badge.unverified {
            background: #e74c3c;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-store"></i> <span>MarketHub</span></h2>
                <button class="toggle-sidebar" id="toggle-sidebar">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
            <ul class="sidebar-menu">
                <li><a href="/" class="nav-link"><i class="fas fa-th-large"></i>
                        <span>Home</span></a>
                </li>
                @if (Auth::check() && Auth::user()->role == 'customer')
                    <li><a href="/checkout" class="nav-link"><i class="fas fa-shopping-basket"></i>
                            <span>Cart</span></a></li>
                @endif
                <li><a href="dashboard" class="nav-link active"><i class="fas fa-th-large"></i>
                        <span>Dashboard</span></a>
                </li>
                <li><a href="profile" class="nav-link"><i class="fas fa-user"></i> <span>Manage Profile</span></a></li>
                @if (Auth::check() && Auth::user()->role == 'vendor')
                    <li><a href="products" class="nav-link"><i class="fas fa-box"></i> <span>Products</span></a></li>
                    <li><a href="transactions" class="nav-link"><i
                                class="fas fa-money-bill-wave"></i><span>Transactions</span></a></li>
                @endif
                {{-- <li><a href="reviews" class="nav-link"><i class="fas fa-star"></i> <span>Product Reviews</span></a></li> --}}
                <li><a href="orders" class="nav-link"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a></li>

                {{-- <li><a href="cart" class="nav-link"><i class="fas fa-shopping-basket"></i> <span>Cart</span></a></li>
                 --}}
                @if (Auth::check() && Auth::user()->role == 'vendor')
                    <li><a href="{{ route('vendor.profile.edit') }}" class="nav-link"><i class="fas fa-cog"></i>
                            <span>Settings</span></a></li>
                @else
                    <li><a href="{{ route('customer.profile') }}" class="nav-link"><i class="fas fa-cog"></i>
                            <span>Settings</span></a></li>
                @endif



                <li>
                    <a href="#" class="nav-link logout-btn">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>


            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content" id="main-content">
            <!-- Header -->
            <div class="header">
                <div class="menu-toggle" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <div class="user-menu">
                    @if (Auth::check() && Auth::user()->role == 'vendor')
                        <div class="notification">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </div>


                        @if (auth()->user()->status == 'active')
                           
                            <span class="badge verified">
                                <i class="check-icon">✔</i> Verified
                            </span>
                        @else
                            <span class="badge unverified">
                                <i class="cross-icon">✖</i> Unverified
                            </span> 
                        @endif
                    @endif

                    @if (Auth::check() && Auth::user()->role == 'customer')
                        <a href="/checkout">
                            <div class="cart-icon" id="cart-icon">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-badge" id="cart-count">0</span>
                            </div>
                        </a>
                    @endif

                    <div class="user-profile" id="user-profile">
                        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="dropdown-menu" id="user-dropdown">
                            <a href="#" class="dropdown-item" data-tab="profile">
                                <i class="fas fa-user"></i> Profile
                            </a>
                            <a href="#" class="dropdown-item" data-tab="settings">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <a href="#" class="dropdown-item logout-btn">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            {{-- <a href="#" class="nav-link" id="logout-btn">
                                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                            </a> --}}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Content Area -->
            <div id="app">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Create Order Modal -->
    <div class="modal" id="create-order-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Create New Order</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <form id="create-order-form">
                    <div class="form-group">
                        <label for="order-customer">Customer</label>
                        <select class="form-control" id="order-customer" required>
                            <option value="">Select Customer</option>
                            <option value="sarah">Sarah Johnson</option>
                            <option value="michael">Michael Brown</option>
                            <option value="emily">Emily Wilson</option>
                            <option value="david">David Miller</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="order-products">Products</label>
                        <select class="form-control" id="order-products" required>
                            <option value="">Select Product</option>
                            <option value="laptop">Premium Gaming Laptop - $1,299.99</option>
                            <option value="smartphone">Smartphone X Pro - $899.99</option>
                            <option value="headphones">Wireless Headphones - $149.99</option>
                            <option value="tablet">Ultra Slim Tablet - $499.99</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="order-quantity">Quantity</label>
                        <input type="number" class="form-control" id="order-quantity" min="1"
                            value="1" required>
                    </div>
                    <div class="form-group">
                        <label for="order-status">Status</label>
                        <select class="form-control" id="order-status" required>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" id="close-order-modal">Cancel</button>
                <button class="btn btn-primary" id="save-order">Create Order</button>
            </div>
        </div>
    </div>



    <script>
        document.querySelectorAll('.logout-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will be logged out.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, logout',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                });
            });
        });
    </script>
</body>

</html>
