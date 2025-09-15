@extends('layouts.vendor')
@section('content')
    <!-- Content Area -->
    <div class="content">
        
        <!-- Products Tab -->
        <div id="products">
            <div class="page-title">
                <h1>Product Management</h1>
                <button class="btn btn-primary" id="add-product-btn"><i class="fas fa-plus"></i> Add New Product</button>
            </div>

            <div class="tabs">
                <div class="tab active" data-product-tab="all">All Products</div>
            </div>

            <div class="product-grid">
                <div class="product-card">
                    <div class="product-image">
                        <img src="https://images.unsplash.com/photo-1603302576837-37561b2e2302?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                            alt="Gaming Laptop">
                    </div>
                    <div class="product-info">
                        <div class="product-title">Premium Gaming Laptop</div>
                        <div class="product-price">$1,299.99</div>
                        <div class="product-meta">
                            <span>12 in stock</span>
                            <span>24 sold</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="action-buttons">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-sm btn-warning edit-product-btn"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger delete-product-btn"><i class="fas fa-trash"></i></button>

                        </div>
                    </div>
                </div>

                @foreach ($products as $p)
                    <div class="product-card">
                        <div class="product-image">
                            @if ($p->images && $p->images->count())
                                <img src="{{ asset('storage/' . $p->images->first()->image_path) }}" alt="{{ $p->name }}">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-title">{{ $p->name }}</div>
                            <div class="product-price">₦{{ number_format($p->price, 2) }}</div>
                            <div class="product-meta">
                                <span>{{ $p->quantity ?? 0 }} in stock</span>
                                <span>{{ $p->sales_count ?? 0 }} sold</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="action-buttons">
                                <button class="btn btn-sm btn-primary view-product-btn" data-target="#view-product-modal-{{ $p->id }}"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-warning edit-product-btn" data-target="#edit-product-modal-{{ $p->id }}"><i class="fas fa-edit"></i></button>

                                {{-- <a href="{{ route('vendor.products.edit', $p->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a> --}}
                                <form action="{{ route('vendor.products.destroy', $p->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return handleDeleteConfirm(this)"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Product Modal -->
                    <div class="modal" id="edit-product-modal-{{ $p->id }}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Edit Product</h2>
                                <span class="close">&times;</span>
                            </div>
                            <div class="modal-body">
                                <form id="edit-product-form-{{ $p->id }}" action="{{ route('vendor.products.update',  $p->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="edit-product-name">Product Name</label>
                                        <input type="text" class="form-control"name="name" value="{{ $p->name }}" id="edit-product-name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-product-name">SKU</label>
                                        <input type="text" class="form-control" name="sku" value="{{ $p->sku }}" id="edit-product-name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-product-description">Description</label>
                                        <textarea class="form-control" name="description" id="edit-product-description" required>{{ $p->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-product-price">Price ($)</label>
                                        <input type="number" class="form-control" name="price" value="{{ $p->price }}" id="edit-product-price" step="0.01" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-product-stock">Stock Quantity</label>
                                        <input type="number" name="quantity" value="{{ $p->quantity }}" class="form-control" id="edit-product-stock" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-product-category">Category</label>
                                        <select class="form-control"  name="category_id" id="edit-product-category" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $c)
                                                <option value="{{ $c->id }}" {{ $p->category_id == $c->id ? 'selected' : '' }}>
                                                    {{ $c->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Images</label>
                                        <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                                        <!-- Preview Area -->
                                        <div id="preview-{{ $p->id }}" class="mt-2 d-flex flex-wrap gap-2"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn close-edit-modal" id="close-view-modal">Cancel</button>
                                        <button class="btn btn-primary update-product" data-id="{{ $p->id }}">Update Product</button>
                
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- View Product Modal -->
                    <div class="modal" id="view-product-modal-{{$p->id}}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Product Details</h2>
                                <span class="close">&times;</span>
                            </div>
                            <div class="modal-body">
                                <div id="modal-product-content">
                                    <div style="display: flex; flex-wrap: wrap; gap: 30px;">
                                        <div style="flex: 1">
                                            @if ($p->images && $p->images->count())
                                            <img src="{{ asset('storage/' . $p->images->first()->image_path) }}" alt="{{ $p->name }}" style="width: 100%; border-radius: 10px;">
                                            @else
                                                <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                                            @endif
                                        </div>
                                        <div style="flex: 1; min-width: 300px;">
                                            <h2 style="margin-bottom: 10px;">{{$p->name}}</h2>
                                            <p style="color: var(--gray); margin-bottom: 20px;">Vendor: {{$p->vendor->shop_name}}</p>
                                            <div style="font-size: 24px; color: var(--primary); font-weight: 700; margin-bottom: 20px;">
                                                ₦{{$p->price}}</div>
                                            <p style="margin-bottom: 20px;">{{$p->description}}</p>
                                            <h3 style="margin-bottom: 10px;">Features:</h3>
                                            <ul style="margin-bottom: 25px; padding-left: 20px;">
                                               
                                               <li>Category: 
                                                    @foreach ($categories as $c)
                                                        @if ($p->category_id == $c->id)
                                                            {{ $c->name }}
                                                        @endif
                                                    @endforeach
                                                </li>
                                                <li>Quantity: {{$p->quantity}}</li>
                                            </ul>

                                            <div class="modal-footer">
                                                <button class="btn btn-primary">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                @endforeach

                    
            </div>

            <div class="pagination-wrapper">
                        {{ $products->links('vendor-pagination') }}
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label>SKU</label>
                            <input type="text" class="form-control" name="sku" value="{{ old('sku') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Price (₦)</label>
                            <input type="number" class="form-control" name="price" step="0.01"
                                value="{{ old('price') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Stock Quantity</label>
                            <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}"
                                        {{ old('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Images</label>
                            <input type="file" class="form-control" id="product-preview" name="images[]" multiple accept="image/*">
                            <div id="image-preview" style="margin-top:10px;">
                                {{-- @if($vendor->shop_banner)
                                    <img src="{{ asset('storage/'.$vendor->shop_banner) }}" width="300">
                                @endif --}}
                                {{-- @if($vendor->shop_banner)
                                    <img src="{{ asset('storage/'.$vendor->shop_banner) }}" alt="Logo">
                                @else
                                    <p>Logo not found!</p>
                                @endif --}}
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn" id="close-modal">Cancel</button>
                            <button class="btn btn-primary" id="save-product">Save Product</button>
                        </div>

                    </form>
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

    </div>

        {{-- @section('scripts') --}}
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

            // @if ($errors->any())
            //         Swal.fire({
            //             title: 'Validation Error',
            //             html: `{!! implode('<br>', $errors->all()) !!}`,
            //             icon: 'error'
            //         });
            // @endif

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
                setupModal(".edit-product-btn", ".close, .close-edit-modal"); 
                setupModal(".delete-product-btn", ".close, #cancel-delete, #confirm-delete");
                setupModal(".view-product-btn", ".close, #close-view-modal");
            });

            

            document.getElementById('product-preview').addEventListener('change', function(e){
                let reader = new FileReader();
                reader.onload = function(event){
                    document.getElementById('image-preview').innerHTML = `<img src="${event.target.result}" width="300">`;
                }
                reader.readAsDataURL(e.target.files[0]);
            });

            // Image preview for edit forms
            document.querySelectorAll('input[name="images[]"]').forEach(input => {
                input.addEventListener('change', function(e) {
                    const previewId = 'preview-' + this.closest('.modal').id.split('-').pop();
                    const previewContainer = document.getElementById(previewId);
                    previewContainer.innerHTML = ''; // Clear previous previews

                    Array.from(this.files).forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const img = document.createElement('img');
                            img.src = event.target.result;
                            img.width = 200;
                            img.style.marginRight = '10px';
                            previewContainer.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    });
                });
            });
        </script>
        

    @endsection
