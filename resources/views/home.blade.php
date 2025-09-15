@extends('layouts.nav')

@section('content')

    <!-- Home Page Content -->
    <div id="home-page" class="page-content active">
        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1>Shop from thousands of vendors in one place</h1>
                        <p>Discover unique products, support small businesses, and enjoy a seamless shopping experience with
                            secure payments and fast delivery.</p>
                        <div class="hero-actions">
                            <a href="#" class="btn btn-primary">Start Shopping</a>
                            <a href="/vendor/register" class="btn btn-outline">Become a Seller</a>
                        </div>
                    </div>
                    <div class="hero-image">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGVjb21tZXJjZXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60"
                            alt="Online Shopping">
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="categories">
            <div class="container">
                <h2 class="section-title">Shop by Category</h2>
                <div class="category-grid">
                    @forelse($categories as $category)
                        <a href="/category/{{ $category->slug}}" class="category-link">
                            <div class="category-card">
                                <div class="category-icon">
                                    {{-- Optional: store icons in DB, fallback to default --}}
                                    @if ($category->name == 'Electronics')
                                        <i class="{{ $category->icon ?? 'fas fa-mobile-alt' }}"></i>
                                    @elseif ($category->name == 'Fashion')
                                        <i class="{{ $category->icon ?? 'fas fa-mobile-alt' }}"></i>
                                    @elseif ($category->name == 'Sports')
                                        <i class="{{ $category->icon ?? 'fas fa-futbol' }}"></i>
                                    @elseif ($category->name == 'Beauty')
                                        <i class="{{ $category->icon ?? 'fas fa-heart' }}"></i>
                                    @else
                                        <i class="{{ $category->icon ?? 'fas fa-home' }}"></i>
                                    @endif


                                </div>
                                <h3>{{ $category->name }}</h3>
                            </div>
                        </a>
                    @empty
                        <p>No categories found.</p>
                    @endforelse
                </div>

            </div>
        </section>

        <!-- Featured Products -->
        <section class="products">
            <div class="container">
                <h2 class="section-title">Featured Products</h2>
                <div class="product-grid">
                    <div class="product-card">
                        <span class="product-badge">Sale</span>
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aGVhZHBob25lc3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60"
                            alt="Wireless Headphones" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">TechGadgets</div>
                            <h3 class="product-title">Wireless Bluetooth Headphones with Noise Cancellation</h3>
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
                            <div class="product-price">$89.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="1"><i class="fas fa-shopping-cart"></i> Add to
                                    Cart</button>
                                <button class="view-product" data-product="1"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="1"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="Sneakers" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">FashionStore</div>
                            <h3 class="product-title">Men's Casual Sneakers - Comfortable Walking Shoes</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="product-reviews">(96 reviews)</span>
                            </div>
                            <div class="product-price">$59.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="2"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="2"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="2"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <span class="product-badge">Popular</span>
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="Kitchen Knife Set" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">HomeEssentials</div>
                            <h3 class="product-title">Stainless Steel Kitchen Knife Set - 6 Pieces</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="product-reviews">(204 reviews)</span>
                            </div>
                            <div class="product-price">$129.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="3"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="3"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="3"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2tpbmNhcmV8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="Skincare Set" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">BeautyCorner</div>
                            <h3 class="product-title">Organic Skincare Set - Face Cream & Serum</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="product-reviews">(147 reviews)</span>
                            </div>
                            <div class="product-price">$49.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="4"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="4"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="4"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div> --}}


                    @forelse($featured as $product)
                        <div class="product-card">
                            @if ($product->discount_price)
                                <span class="product-badge">Sale</span>
                            @endif



                            @if ($product->images && $product->images->count())
                                <img class="product-image"
                                    src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                    alt="{{ $product->name }}">
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
                                    @if ($product->discount_price)
                                        <span class="text-red-600">₦{{ $product->discount_price }}</span>
                                        <del class="text-gray-500">₦{{ $product->price }}</del>
                                    @else
                                        ₦{{ $product->price }}
                                    @endif
                                </div>

                                <div class="product-actions">

                                    <button class="add-to-cart" data-product-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-price="{{ $product->discount_price ?? $product->price }}"
                                        data-vendor="{{ $product->vendor->id ?? 'Unknown Vendor' }}"
                                        data-image="{{ $product->images && $product->images->count() ? asset('storage/' . $product->images->first()->image_path) : asset('images/no-image.png') }}"><i
                                            class="fas fa-shopping-cart"></i>Add to Cart</button>

                                    <button class="view-product view-product-btn"
                                        data-target="#productModal-{{ $product->id }}"><i class="fas fa-eye"></i>
                                        View</button>

                                    <button class="wishlist" data-product="{{ $product->id }}">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <!-- Product Modal -->
                        <div class="modal" id="productModal-{{ $product->id }}">
                            <div class="modal-content">
                                <span class="close-modal">&times;</span>
                                <div id="modal-product-content">
                                    <!-- Content will be loaded by JavaScript -->

                                    <div style="display: flex; flex-wrap: wrap; gap: 30px;">
                                        <div style="flex: 1; min-width: 300px;">

                                            @if ($product->images && $product->images->count())
                                                <img style="width: 100%; border-radius: 10px;" class="product-image"
                                                    src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                                    alt="{{ $product->name }}">
                                            @else
                                                <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                                            @endif
                                        </div>


                                        <div style="flex: 1; min-width: 300px;">
                                            <h2 style="margin-bottom: 10px;">{{ Str::limit($product->name, 50) }}</h2>
                                            <p style="color: var(--gray); margin-bottom: 20px;">Vendor:
                                                {{ $product->vendor->shop_name ?? 'Unknown Vendor' }}</p>
                                            <div
                                                style="font-size: 24px; color: var(--primary); font-weight: 700; margin-bottom: 20px;">
                                                ₦{{ $product->price }}</div>
                                            <h3 style="margin-bottom: 10px;">Features:</h3>
                                            <ul style="margin-bottom: 25px; padding-left: 20px;">
                                                <!-- ${product.features.map(feature => `<li>${feature}</li>`).join('')} -->
                                                <p style="margin-bottom: 20px;">{{ $product->description }}</p>
                                            </ul>
                                            <div style="margin-bottom: 20px;">
                                                <h3 style="margin-bottom: 10px;">Rate this product:</h3>
                                                <div class="rating">
                                                    <input type="radio" id="star5-{{ $product->id }}"
                                                        name="rating-{{ $product->id }}" value="5" />
                                                    <label for="star5-{{ $product->id }}"></label>
                                                    <input type="radio" id="star4-{{ $product->id }}"
                                                        name="rating-{{ $product->id }}" value="4" />
                                                    <label for="star4-{{ $product->id }}"></label>
                                                    <input type="radio" id="star3-{{ $product->id }}"
                                                        name="rating-{{ $product->id }}" value="3" />
                                                    <label for="star3-{{ $product->id }}"></label>
                                                    <input type="radio" id="star2-{{ $product->id }}"
                                                        name="rating-{{ $product->id }}" value="2" />
                                                    <label for="star2-{{ $product->id }}"></label>
                                                    <input type="radio" id="star1-{{ $product->id }}"
                                                        name="rating-{{ $product->id }}" value="1" />
                                                    <label for="star1-{{ $product->id }}"></label>
                                                </div>
                                            </div>
                                            <div style="display: flex; gap: 10px;">
                                                <button class="add-to-cart" data-product-id="{{ $product->id }}"
                                                    data-name="{{ $product->name }}"
                                                    data-price="{{ $product->discount_price ?? $product->price }}"
                                                    data-vendor="{{ $product->vendor->id ?? 'Unknown Vendor' }}"
                                                    data-image="{{ $product->images && $product->images->count() ? asset('storage/' . $product->images->first()->image_path) : asset('images/no-image.png') }}"
                                                    style="padding: 12px 20px;"><i class="fas fa-shopping-cart"></i> Add
                                                    to Cart</button>
                                                <button class="wishlist" data-product="{{ $product->id }}"
                                                    style="width: 50px;"><i class="far fa-heart"></i></button>
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
                 <br>
                    
                    <div class="pagination-wrapper">
                        {{ $featured->links('vendor-pagination') }}
                    </div>
            </div>
        </section>

        <!-- Featured Vendors -->
        <section class="vendors">
            <div class="container">
                <h2 class="section-title">Featured Vendors</h2>
                <div class="vendor-grid">
                    <div class="vendor-card">
                        <img src="https://images.unsplash.com/photo-1628563694622-5a76957fd09c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dGVjaCUyMGxvZ298ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60"
                            alt="TechGadgets" class="vendor-avatar">
                        <h3 class="vendor-name">TechGadgets</h3>
                        <div class="vendor-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>(128)</span>
                        </div>
                        <div class="vendor-products">245 Products</div>
                        <a href="#" class="view-store">Visit Store</a>
                    </div>

                    <div class="vendor-card">
                        <img src="https://images.unsplash.com/photo-1545235617-9465d2a55698?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8ZmFzaGlvbiUyMGxvZ298ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60"
                            alt="FashionStore" class="vendor-avatar">
                        <h3 class="vendor-name">FashionStore</h3>
                        <div class="vendor-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>(96)</span>
                        </div>
                        <div class="vendor-products">312 Products</div>
                        <a href="#" class="view-store">Visit Store</a>
                    </div>

                    <div class="vendor-card">
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGhvbWUlMjBsb2dvfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60"
                            alt="HomeEssentials" class="vendor-avatar">
                        <h3 class="vendor-name">HomeEssentials</h3>
                        <div class="vendor-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>(204)</span>
                        </div>
                        <div class="vendor-products">178 Products</div>
                        <a href="#" class="view-store">Visit Store</a>
                    </div>

                    @forelse ($featuredVendors as $vendor)
                        @if ($vendor->products_count > 0)
                            <div class="vendor-card">
                                @if ($vendor->shop_logo)
                                    <img src="{{ asset('storage/' . $vendor->shop_logo) }}" alt="{{ $vendor->name }}"
                                        class="vendor-avatar">
                                @else
                                    <img src="https://images.unsplash.com/photo-1628563694622-5a76957fd09c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dGVjaCUyMGxvZ298ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60"
                                        alt="TechGadgets" class="vendor-avatar">
                                @endif

                                <h3 class="vendor-name">{{ $vendor->shop_name }}</h3>
                                <div class="vendor-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>(147)</span>
                                </div>
                                <div class="vendor-products">

                                    @if ($vendor->products_count > 0)
                                        {{ $vendor->products_count }} Product
                                    @else
                                        No Products Yet
                                    @endif
                                </div>


                                {{-- <a href="#" class="view-store">Visit Store</a> --}}
                                <a href="{{ route('vendors.shop', $vendor->shop_slug) }}" class="view-store">Visit
                                    Store</a>

                            </div>
                        @else
                        @endif
                    @empty
                        <p>No featured vendors available.</p>
                    @endforelse
                </div>
            </div>

        </section>
    </div>



    {{-- Toys --}}
    <div id="toys-page" class="page-content">
        <div class="container">
            <div class="category-page-header">
                <h2>{{ $category->name }}</h2>
                <p>Discover Toys</p>
            </div>

            <div class="products">
                <h2 class="section-title">Sports Products</h2>
                <div class="product-grid">
                    <div class="product-card">
                        <span class="product-badge">Sale</span>
                        <img src="https://images.unsplash.com/photo-1532298229144-0ec0c57515c7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8YmljeWNsZXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60"
                            alt="Bicycle" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">SportsWorld</div>
                            <h3 class="product-title">Mountain Bike - 21 Speed Gears</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="product-reviews">(76 reviews)</span>
                            </div>
                            <div class="product-price">$299.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="14"><i class="fas fa-shopping-cart"></i> Add to
                                    Cart</button>
                                <button class="view-product" data-product="14"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="14"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    @forelse($featured as $product)
                        @if ($product->category && $product->category->name === $category->name)
                            <div class="product-card">
                                <img src="{{ $product->images->first()->url ?? '/images/default.jpg' }}"
                                    alt="{{ $product->name }}">
                                <h4>{{ $product->name }}</h4>
                                <p>${{ number_format($product->price, 2) }}</p>
                            </div>
                        @endif
                    @empty
                        <p>No products found in this category.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>


    <!-- Vendors Page Content -->
    <div id="vendors-page" class="page-content">
        <div class="container">
            <div class="category-page-header">
                <h2>Vendors</h2>
                <p>Discover our trusted vendors and their stores</p>
            </div>

            <div class="vendors">
                <h2 class="section-title">Featured Vendors</h2>
                <div class="vendor-grid">
                    @forelse ($featuredVendors as $vendor)
                        <div class="vendor-card">
                            <img src="{{ $vendor->logo_url }}" alt="{{ $vendor->name }}" class="vendor-avatar">
                            <h3 class="vendor-name">{{ $vendor->name }}</h3>
                            <div class="vendor-rating">
                                @for ($i = 0; $i < floor($vendor->rating); $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @if ($vendor->rating - floor($vendor->rating) >= 0.5)
                                    <i class="fas fa-star-half-alt"></i>
                                @endif
                                @for ($i = ceil($vendor->rating); $i < 5; $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                                <span>({{ $vendor->reviews_count }})</span>
                            </div>
                            <div class="vendor-products">{{ $vendor->products_count }} Products</div>
                            {{-- <a href="{{ route('vendors.show', $vendor->id) }}" class="view-store">Visit Store</a> --}}
                        </div>
                    @empty
                        <p>No vendors found.</p>
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
