@extends('layouts.vendor')
@section('title', 'Vendor Orders')
@section('content')


    <!-- Content Area -->
    <div class="content">

        <!-- Orders Tab -->
        <div id="orders">
            <div class="page-title">
                <h1>Order Management</h1>
                <div>Today: <span id="current-date">Monday, Oct 16, 2023</span></div>

            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Recent Orders</h2>
                    <div class="action-buttons">
                        <button class="btn btn-sm btn-primary">All Orders</button>
                        <button class="btn btn-sm btn-success">Completed</button>
                        <button class="btn btn-sm btn-warning">Pending</button>
                        <button class="btn btn-sm btn-danger">Cancelled</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Name</th>
                                    <th>*Price</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->count() > 0)
                                    @foreach ($orders as $order)
                                        <tr>


                                            <td>{{ $order->order_number }}</td>
                                            <td>{{ $order->customer->name }}</td>
                                            {{-- <td>{{ $order->product->name }}</td> --}}
                                            <td>
                                                {{ $order->items->first() ? $order->items->first()->product->name : 'No Product' }}
                                            </td>
                                            <td>₦{{ $order->items->first() ? number_format($order->items->first()->product->price, 2) : '0.00' }}
                                            </td>

                                            <td>
                                                @php
                                                    $firstItem = $order->items->first();
                                                    $image =
                                                        $firstItem && $firstItem->product->images->first()
                                                            ? $firstItem->product->images->first()->image_path
                                                            : null;
                                                    $imageUrl = $image
                                                        ? asset('storage/' . $image)
                                                        : asset('images/default-product.png');
                                                @endphp
                                                <img src="{{ $imageUrl }}"
                                                    alt="{{ $firstItem ? $firstItem->product->name : 'No Product' }}"
                                                    width="50" style="margin-right:5px;">
                                            </td>
                                            <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                                            <td>{{ $order->items->count() }}</td>


                                            <td>₦{{ number_format($order->total_amount, 2) }}</td>
                                            <td>
                                                @if ($order->status == 'shipped')
                                                    <span class="badge badge-primary">Shipped</span>
                                                @elseif($order->status == 'processing')
                                                    <span class="badge badge-info">Processing</span>
                                                @elseif($order->status == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($order->status == 'delivered')
                                                    <span class="badge badge-success">Delivered</span>
                                                @elseif($order->status == 'confirmed')
                                                    <span class="badge badge-success">Confirmed</span>
                                                @elseif($order->status == 'refunded')
                                                    <span class="badge badge-info">Refunded</span>
                                                @elseif($order->status == 'cancelled')
                                                    <span class="badge badge-danger">Cancelled</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-primary view-order-btn"><i
                                                            class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-warning edit-order-btn"
                                                        data-target="#edit-order-modal-{{ $order->id }}"><i
                                                            class="fas fa-edit"></i></button>
                                                    {{-- <button class="btn btn-sm btn-danger delete-order-btn"><i class="fas fa-trash"></i></button> --}}
                                                    <form action="{{ route('vendor.orders.destroy', $order->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return handleDeleteConfirm(this)"><i
                                                                class="fas fa-trash"></i></button>
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
                                                        action="{{ route('vendor.orders.updateStatus', $order->id) }}"
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
    </div>
    <!-- Add Product Modal -->
    <div class="modal" id="add-product-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Product</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <form id="add-product-form">
                    <div class="form-group">
                        <label for="product-name">Product Name</label>
                        <input type="text" class="form-control" id="product-name" required>
                    </div>
                    <div class="form-group">
                        <label for="product-description">Description</label>
                        <textarea class="form-control" id="product-description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="product-price">Price ($)</label>
                        <input type="number" class="form-control" id="product-price" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="product-stock">Stock Quantity</label>
                        <input type="number" class="form-control" id="product-stock" required>
                    </div>
                    <div class="form-group">
                        <label for="product-category">Category</label>
                        <select class="form-control" id="product-category" required>
                            <option value="">Select Category</option>
                            <option value="electronics">Electronics</option>
                            <option value="fashion">Fashion</option>
                            <option value="home">Home & Garden</option>
                            <option value="sports">Sports</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" id="close-modal">Cancel</button>
                <button class="btn btn-primary" id="save-product">Save Product</button>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal" id="edit-product-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Product</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <form id="edit-product-form">
                    <div class="form-group">
                        <label for="edit-product-name">Product Name</label>
                        <input type="text" class="form-control" id="edit-product-name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-product-description">Description</label>
                        <textarea class="form-control" id="edit-product-description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-product-price">Price ($)</label>
                        <input type="number" class="form-control" id="edit-product-price" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-product-stock">Stock Quantity</label>
                        <input type="number" class="form-control" id="edit-product-stock" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-product-category">Category</label>
                        <select class="form-control" id="edit-product-category" required>
                            <option value="">Select Category</option>
                            <option value="electronics">Electronics</option>
                            <option value="fashion">Fashion</option>
                            <option value="home">Home & Garden</option>
                            <option value="sports">Sports</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" id="close-edit-modal">Cancel</button>
                <button class="btn btn-primary" id="update-product">Update Product</button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="delete-confirm-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirm Deletion</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this item? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button class="btn" id="cancel-delete">Cancel</button>
                <button class="btn btn-danger" id="confirm-delete">Delete</button>
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
                        <input type="number" class="form-control" id="order-quantity" min="1" value="1"
                            required>
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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            // Swal.fire('Success!', '{{ session('success') }}', 'success');
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        @if (session('error'))
            Swal.fire('Error!', '{{ session('error') }}', 'error');
        @endif

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
            // setupModal(".delete-product-btn", ".close, #cancel-delete, #confirm-delete");
            // setupModal(".view-product-btn", ".close, #close-view-modal");
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
