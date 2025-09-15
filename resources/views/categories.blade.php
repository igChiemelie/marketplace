@extends('layouts.nav')
@section('content')

    <!-- Electronics Page Content -->
    <br>
    <div id="electronics-page">
        <div class="container">
            <div class="category-page-header">
                {{-- <h2>Electronics</h2> --}}
                <h2>{{ $category->name }}</h2>
                <p>Discover the latest gadgets and technology</p>
            </div>
            
            <div class="products">
                <h2 class="section-title">{{ $category->name }} Products</h2>
                <div class="product-grid">
                    @forelse($featured as $product)
                        <div class="product-card">
                            @if($product->discount_price)
                                <span class="product-badge">Sale</span>
                            @endif
                            
                            @if ($product->images && $product->images->count())
                                <img  class="product-image" src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                            @endif
                            
                            <div class="product-info">
                                <div class="product-vendor">
                                    {{ $product->vendor->shop_name ?? 'Unknown Vendor' }}
                                </div>
                                
                                <h3 class="product-title">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        {{ Str::limit($product->name, 50) }}
                                    </a>
                                </h3>
                                
                                {{-- Ratings (optional if you store them) --}}
                                <div class="product-rating">
                                    <div class="product-stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    {{-- <span class="product-reviews">(128 reviews)</span> --}}
                                </div>
                                
                                {{-- Price --}}
                                <div class="product-price">
                                    @if($product->discount_price)
                                        <span class="text-red-600">₦{{ $product->discount_price }}</span>
                                        <del class="text-gray-500">₦{{ $product->price }}</del>
                                    @else
                                        ₦{{ $product->price }}
                                    @endif
                                </div>
                                
                                <div class="product-actions">
                                 
                                    <button class="add-to-cart" data-product-id="{{ $product->id }}"  data-name="{{ $product->name }}"
                                        data-price="{{ $product->discount_price ?? $product->price }}"
                                        data-vendor="{{$product->vendor->id ?? 'Unknown Vendor'}}"
                                        data-image="{{ $product->images && $product->images->count() ? asset('storage/' . $product->images->first()->image_path) : asset('images/no-image.png') }}"><i class="fas fa-shopping-cart"></i>Add to Cart</button>

                                    <button class="view-product view-product-btn" data-target="#productModal-{{$product->id}}"><i class="fas fa-eye"></i> View</button>

                                    <button class="wishlist" data-product="{{ $product->id }}">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <!-- Product Modal -->
                        <div class="modal" id="productModal-{{$product->id}}">
                            <div class="modal-content">
                                <span class="close-modal">&times;</span>
                                <div id="modal-product-content">
                                    <!-- Content will be loaded by JavaScript -->
                                    
                                    <div style="display: flex; flex-wrap: wrap; gap: 30px;">
                                        <div style="flex: 1; min-width: 300px;">
                                            
                                            @if ($product->images && $product->images->count())
                                                <img style="width: 100%; border-radius: 10px;" class="product-image" src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}">
                                            @else
                                                <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                                            @endif
                                        </div>

                                        
                                        <div style="flex: 1; min-width: 300px;">
                                            <h2 style="margin-bottom: 10px;">{{ Str::limit($product->name, 50) }}</h2>
                                            <p style="color: var(--gray); margin-bottom: 20px;">Vendor: {{ $product->vendor->shop_name ?? 'Unknown Vendor' }}</p>
                                            <div style="font-size: 24px; color: var(--primary); font-weight: 700; margin-bottom: 20px;">₦{{ $product->price }}</div>
                                            <h3 style="margin-bottom: 10px;">Features:</h3>
                                            <ul style="margin-bottom: 25px; padding-left: 20px;">
                                                <!-- ${product.features.map(feature => `<li>${feature}</li>`).join('')} -->
                                                <p style="margin-bottom: 20px;">{{ $product->description }}</p>
                                            </ul>
                                            <div style="margin-bottom: 20px;">
                                                <h3 style="margin-bottom: 10px;">Rate this product:</h3>
                                                <div class="rating">
                                                    <input type="radio" id="star5-{{ $product->id }}" name="rating-{{ $product->id }}" value="5" />
                                                    <label for="star5-{{ $product->id }}"></label>
                                                    <input type="radio" id="star4-{{ $product->id }}" name="rating-{{ $product->id }}" value="4" />
                                                    <label for="star4-{{ $product->id }}"></label>
                                                    <input type="radio" id="star3-{{ $product->id }}" name="rating-{{ $product->id }}" value="3" />
                                                    <label for="star3-{{ $product->id }}"></label>
                                                    <input type="radio" id="star2-{{ $product->id }}" name="rating-{{ $product->id }}" value="2" />
                                                    <label for="star2-{{ $product->id }}"></label>
                                                    <input type="radio" id="star1-{{ $product->id }}" name="rating-{{ $product->id }}" value="1" />
                                                    <label for="star1-{{ $product->id }}"></label>
                                                </div>
                                            </div>
                                            <div style="display: flex; gap: 10px;">
                                                <button class="add-to-cart" data-product-id="{{ $product->id }}"  data-name="{{ $product->name }}"
                                                    data-price="{{ $product->discount_price ?? $product->price }}"
                                                    data-vendor="{{$product->vendor->id ?? 'Unknown Vendor'}}"
                                                    data-image="{{ $product->images && $product->images->count() ? asset('storage/' . $product->images->first()->image_path) : asset('images/no-image.png') }}" style="padding: 12px 20px;"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                                <button class="wishlist" data-product="{{ $product->id }}" style="width: 50px;"><i class="far fa-heart"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No featured products available.</p>

                    @endforelse
                </div>
            </div>
        </div>
    </div>

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
            console.log("JS Loaded: attaching modals...");
            setupModal(".view-product-btn", ".close-modal, #close-view-modal");
        });

    </script>

@endsection
