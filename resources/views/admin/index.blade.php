@extends('layouts.admin')
@section('content')
    <!-- Dashboard Tab -->
    <div class="tab-content active" id="dashboard">
        <div class="page-title">
            <h1>Admin Dashboard</h1>
            <div>Today: <span id="current-date">Monday, Oct 16, 2023</span></div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>{{$users->count()}}</h3>
                    <p>Total Vendors</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-info">
                    <h3>{{$orders->count()}}</h3>
                    <p>Total Orders</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-warning">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-info">
                    <h3>{{$products->count()}}</h3>
                    <p>Total Products</p>
                </div>
            </div>
            {{-- <div class="stat-card">
                <div class="stat-icon bg-info">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-info">
                    <h3>$256,890</h3>
                    <p>Total Revenue</p>
                </div>
            </div> --}}
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Recent Activities</h2>
                <a href="orders"><button class="btn btn-primary">View All</button></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {{-- <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Activity</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sarah Johnson</td>
                                <td>Updated product information</td>
                                <td>10:25 AM</td>
                                <td><span class="badge badge-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Michael Brown</td>
                                <td>Processed order #ORD-7255</td>
                                <td>09:42 AM</td>
                                <td><span class="badge badge-primary">In Progress</span></td>
                            </tr>
                            <tr>
                                <td>Emily Wilson</td>
                                <td>Added new product category</td>
                                <td>Yesterday</td>
                                <td><span class="badge badge-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>David Miller</td>
                                <td>Resolved customer ticket</td>
                                <td>Yesterday</td>
                                <td><span class="badge badge-info">Reviewed</span></td>
                            </tr>
                        </tbody>
                    </table> --}}
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Date</th>
                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if($orders->count() > 0)
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>#ORD-{{ $order->order_number }}</td>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>{{ $order->items->count() }}</td>
                                        <td>₦{{ number_format($order->total_amount, 2) }}</td>
                                        <td>{{ $order->payment_method}}</td>
                                        <td>
                                            @if($order->status == 'shipped')
                                                <span class="badge badge-primary">Shipped</span>
                                            @elseif($order->status == 'processing')
                                                <span class="badge badge-info">Processing</span>
                                            @elseif($order->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($order->status == 'delivered')
                                                <span class="badge badge-success">Delivered</span>
                                            @elseif($order->status == 'cancelled')
                                                <span class="badge badge-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>

                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-sm btn-primary view-order-btn"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-warning edit-order-btn" data-target="#edit-order-modal-{{ $order->id }}"><i class="fas fa-edit"></i></button>

                                                {{-- <button class="btn btn-sm btn-warning edit-order-btn"><i class="fas fa-edit"></i></button> --}}
                                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                                                 {{-- admin.orders.destroy --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger delete-order-btn" onclick="return handleDeleteConfirm(this)"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>   

                                    <!-- Edit Product Modal -->
                                        <div class="modal" id="edit-order-modal-{{ $order->id }}">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2>Edit Status</h2>
                                                    <span class="close">&times;</span>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="edit-product-form-{{ $order->id }}"
                                                        action="{{ route('admin.orders.updateStatus', $order->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('patch')
                                                        <div class="form-group">
                                                            <label for="edit-product-category">Status</label>
                                                            <select class="form-control" name="status"
                                                                id="edit-product-category" required>
                                                                <option value="">Change Status</option>
                                                                @php
                                                                    $statuses = [
                                                                        'pending',
                                                                        'confirmed',
                                                                        'processing',
                                                                        'shipped',
                                                                        'delivered',
                                                                        'cancelled',
                                                                        'refunded',
                                                                    ];
                                                                @endphp
                                                                @foreach ($statuses as $status)
                                                                    <option value="{{ $status }}"
                                                                        {{ $order->status === $status ? 'selected' : '' }}>
                                                                        {{ ucfirst($status) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="modal-footer">
                                                            {{-- <button class="btn close-modal" id="close-modal">Cancel</button> --}}
                                                            <button class="btn btn-primary update-product"
                                                                data-id="{{ $order->id }}">Change</button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No orders found.</td>
                                </tr>    
                            @endif   
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                    {{ $orders->links('vendor-pagination') }}
                </div>
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
    <script>
        // Generic modal setup (using data-target for each button)
        function setupModal(triggerSelector, closeSelectors) {
            const triggers = document.querySelectorAll(triggerSelector);

            triggers.forEach(trigger => {
                const modalSelector = trigger.getAttribute("data-target");
                const modal = document.querySelector(modalSelector);
                if (!modal) return;

                const closes = modal.querySelectorAll(closeSelectors);

                // Open modal on trigger click
                trigger.addEventListener("click", (e) => {
                    e.preventDefault();
                    modal.style.display = "flex";
                });

                // Close modal on "X" or "Cancel"
                closes.forEach(closeBtn => {
                    closeBtn.addEventListener("click", () => {
                        modal.style.display = "none";
                    });
                });

                // Close modal if clicking outside content
                window.addEventListener("click", (e) => {
                    if (e.target === modal) modal.style.display = "none";
                });
            });
        }

        document.addEventListener("DOMContentLoaded", () => {
            console.log('here');

            // Attach modals
            setupModal(".edit-order-btn", ".close, .close-edit-modal");
            
        });

        function handleDeleteConfirm(button) {
            event.preventDefault(); // Prevent form submission
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit(); // Submit the form if confirmed
                }
            });
            return false;
        }
    </script>

@endsection
