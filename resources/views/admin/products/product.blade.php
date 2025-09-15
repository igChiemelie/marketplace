@extends('layouts.admin')
@section('content')
<!-- Products Tab -->
<div class="" id="products">
    <div class="page-title">
        <h1>Product Management</h1>
        <div>Today: <span id="current-date">Monday, Oct 16, 2023</span></div>
        
    </div>
    
    <div class="card">
        <div class="card-header">
            <h2>All Products</h2>
            <div class="action-buttons">
                <button class="btn btn-primary" id="add-product-btn"><i class="fas fa-plus"></i> Add Product</button>

            </div>
        </div>
        <div class="card-body">
            {{-- {{$products}} --}}
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Shop</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Img</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    
                    @forelse ($products as $product)
                        
                        <?php 
                        // dd($product);
                         ?>
                        
                        <tbody>
                            <tr>
                                <td>#PRD-{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @foreach ($categories as $c)
                                        @if ($product->category_id == $c->id)
                                            {{ $c->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $product->vendor->shop_name ?? 'Admin Shop' }}</td>
                                <td>₦{{number_format($product->price, 2) }}</td>
                                <td>
                                    <span class="badge badge-danger">{{$product->quantity}}</span>
                                    {{-- {{$product->quantity}} --}}
                                </td>
                                <td>
                                    @if($product->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($product->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->images && $product->images->count())
                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}"  width="40" class="rounded">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                                    @endif

                                </td>
                                

                                <td>
                                    <div class="action-buttons">
                                        {{-- <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a> --}}
                                        <button class="btn btn-sm btn-success view-product-btn" style="color: black" data-target="#view-product-modal-{{ $product->id }}">
                                            <i class="fas fa-eye"></i> View...
                                        </button>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                            
                                        </form>
                                    </div>
                                </td>
                            </tr>
                           
                        </tbody>

                        <!-- View Product Modal -->
                        <div class="modal hide" id="view-product-modal-{{$product->id}}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2>Product Details</h2>
                                    <span class="close">&times;</span>
                                </div>
                                <div class="modal-body">
                                    <div id="modal-product-content">
                                        <div style="display: flex; flex-wrap: wrap; gap: 30px;">
                                            <div style="flex: 1">
                                                @if ($product->images && $product->images->count())
                                                    @foreach ($product->images as $img)
                                                        <img src="{{ asset('storage/'.$img->image_path) }}" style="width: 100%; border-radius: 10px;">
                                                    @endforeach

                                                    {{-- <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" style="width: 100%; border-radius: 10px;"> --}}
                                                @else
                                                    <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                                                @endif
                                            </div>
                                            <div style="flex: 1; min-width: 300px;">
                                                <h2 style="margin-bottom: 10px;">{{$product->name}}</h2>
                                                <p style="color: var(--gray); margin-bottom: 20px;">Vendor: {{ $product->vendor->shop_name ?? 'Admin Shop' }}</p>
                                                <div style="font-size: 24px; color: var(--primary); font-weight: 700; margin-bottom: 20px;">
                                                    ₦{{$product->price}}</div>
                                                <p style="margin-bottom: 20px;">{{$product->description}}</p>
                                                <h3 style="margin-bottom: 10px;">Features:</h3>
                                                <ul style="margin-bottom: 25px; padding-left: 20px;">
                                                
                                                    <li>Category: 
                                                        @foreach ($categories as $c)
                                                            @if ($product->category_id == $c->id)
                                                                {{ $c->name }}
                                                            @endif
                                                        @endforeach
                                                    </li>
                                                    <li>Quantity: {{$product->quantity}}</li>
                                                </ul>

                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" id="close-view-modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                     @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No products found.</td>
                        </tr>
                    @endforelse
                </table>
                <!-- Pagination -->      
                <div class="pagination-wrapper">
                    {{ $products->links('vendor-pagination') }}
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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
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