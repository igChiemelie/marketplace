<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    @vite(['resources/custom/css/admin.css', 'resources/custom/js/admin.js'])

</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-cog"></i> <span>Admin Panel</span></h2>
                <button class="toggle-sidebar" id="toggle-sidebar">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard" class="active"><i class="fas fa-th-large"></i> <span>Dashboard</span></a></li>
                <li><a href="cms"><i class="fas fa-edit"></i> <span>CMS</span></a></li>
                <li><a href="vendors"><i class="fas fa-users"></i> <span>User Management</span></a></li>
                <li><a href="products" data-tab="products"><i class="fas fa-box"></i> <span>Products</span></a></li>
                <li><a href="orders" data-tab="orders"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a></li>
                <li><a href="analytics" data-tab="analytics"><i class="fas fa-chart-line"></i> <span>Analytics</span></a></li>
                <li><a href="settings" data-tab="settings"><i class="fas fa-cogs"></i> <span>Settings</span></a></li>
                <li>
                    <a href="#" class="logout-btn"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
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
                    {{-- <div class="notification">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">5</span>
                    </div> --}}
                    <div class="user-profile" id="user-profile">
                
                        <div class="user-avatar">{{strtoupper (substr(Auth::user()->name, 0,2))}}</div>
                        <div class="user-name">{{ (Auth::user()->name)}}</div>
                        <div class="dropdown-menu" id="user-dropdown">
                            <a href="#" class="dropdown-item" data-tab="profile">
                                <i class="fas fa-user"></i> Profile
                            </a>
                            <a href="settings" class="dropdown-item" data-tab="settings">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <a href="#" class="dropdown-item logout-btn" id="dropdown-logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content">
                <div id="app">
                    
                    @yield('content')
                   
                </div>
              
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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