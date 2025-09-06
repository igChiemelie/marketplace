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
                        <p>Discover unique products, support small businesses, and enjoy a seamless shopping experience with secure payments and fast delivery.</p>
                        <div class="hero-actions">
                            <a href="#" class="btn btn-primary">Start Shopping</a>
                            <a href="/vendor/register" class="btn btn-outline">Become a Seller</a>
                        </div>
                    </div>
                    <div class="hero-image">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGVjb21tZXJjZXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="Online Shopping">
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="categories">
            <div class="container">
                <h2 class="section-title">Shop by Category</h2>
                <div class="category-grid">
                    <div class="category-card" data-category="electronics">
                        <div class="category-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3>Electronics</h3>
                    </div>
                    
                    <div class="category-card" data-category="fashion">
                        <div class="category-icon">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <h3>Fashion</h3>
                    </div>
                    
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h3>Home & Garden</h3>
                    </div>
                    
                    <div class="category-card" data-category="beauty">
                        <div class="category-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>Beauty</h3>
                    </div>
                    
                    <div class="category-card" data-category="sports">
                        <div class="category-icon">
                            <i class="fas fa-futbol"></i>
                        </div>
                        <h3>Sports</h3>
                    </div>
                    
                   
                </div>
            </div>
        </section>

        <!-- Featured Products -->
        <section class="products">
            <div class="container">
                <h2 class="section-title">Featured Products</h2>
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
                                {{-- <div class="product-rating">
                                    <div class="product-stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="product-reviews">(128 reviews)</span>
                                </div> --}}
                                
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
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="cart-form">
                                        @csrf
                                        <button type="submit" class="add-to-cart-btn">
                                            <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </button>
                                    </form>

                                    <a href="{{ route('products.show', $product->slug) }}" class="view-product">
                                        <i class="fas fa-eye"></i> View
                                    </a>

                                    <button class="wishlist" data-product="{{ $product->id }}">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>

                            </div>
                        </div>
                    @empty
                        <p>No featured products available.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Featured Vendors -->
        <section class="vendors">
            <div class="container">
                <h2 class="section-title">Featured Vendors</h2>
                <div class="vendor-grid">
                    <div class="vendor-card">
                        <img src="https://images.unsplash.com/photo-1628563694622-5a76957fd09c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dGVjaCUyMGxvZ298ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="TechGadgets" class="vendor-avatar">
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
                        <img src="https://images.unsplash.com/photo-1545235617-9465d2a55698?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8ZmFzaGlvbiUyMGxvZ298ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="FashionStore" class="vendor-avatar">
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
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGhvbWUlMjBsb2dvfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="HomeEssentials" class="vendor-avatar">
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
                    
                    <div class="vendor-card">
                        <img src="https://images.unsplash.com/photo-1634942536746-46b9a6de9231?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8YmVhdXR5JTIwbG9nb3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="BeautyCorner" class="vendor-avatar">
                        <h3 class="vendor-name">BeautyCorner</h3>
                        <div class="vendor-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>(147)</span>
                        </div>
                        <div class="vendor-products">165 Products</div>
                        <a href="#" class="view-store">Visit Store</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Electronics Page Content -->
    <div id="electronics-page" class="page-content">
        <div class="container">
            <div class="category-page-header">
                <h2>Electronics</h2>
                <p>Discover the latest gadgets and technology</p>
            </div>
            
            <div class="products">
                <h2 class="section-title">Electronics Products</h2>
                <div class="product-grid">
                    <div class="product-card">
                        <span class="product-badge">Sale</span>
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aGVhZHBob25lc3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="Wireless Headphones" class="product-image">
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
                                <span class="product-reviews">(128 reviews)</span>
                            </div>
                            <div class="product-price">$89.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="1"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="1"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="1"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1541807084-5c52b6b3adef?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8bGFwdG9wfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="Laptop" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">TechGadgets</div>
                            <h3 class="product-title">Ultra-Thin Laptop with 15.6" Display</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="product-reviews">(87 reviews)</span>
                            </div>
                            <div class="product-price">$899.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="5"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="5"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="5"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <span class="product-badge">New</span>
                        <img src="https://images.unsplash.com/photo-1572536147248-ac59a8abfa4b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fHNtYXJ0d2F0Y2h8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="Smartwatch" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">TechGadgets</div>
                            <h3 class="product-title">Smart Watch with Fitness Tracking</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="product-reviews">(142 reviews)</span>
                            </div>
                            <div class="product-price">$199.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="6"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="6"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="6"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aGVhZHBob25lc3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="Wireless Earbuds" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">TechGadgets</div>
                            <h3 class="product-title">True Wireless Earbuds with Charging Case</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="product-reviews">(96 reviews)</span>
                            </div>
                            <div class="product-price">$79.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="7"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="7"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="7"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fashion Page Content -->
    <div id="fashion-page" class="page-content">
        <div class="container">
            <div class="category-page-header">
                <h2>Fashion</h2>
                <p>Discover the latest trends in clothing and accessories</p>
            </div>
            
            <div class="products">
                <h2 class="section-title">Fashion Products</h2>
                <div class="product-grid">
                    <div class="product-card">
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
                        <span class="product-badge">New</span>
                        <img src="https://images.unsplash.com/photo-1525507119028-ed4c629a60a3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8dCUyMHNoaXJ0fGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="T-Shirt" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">FashionStore</div>
                            <h3 class="product-title">Premium Cotton T-Shirt - Multiple Colors</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="product-reviews">(124 reviews)</span>
                            </div>
                            <div class="product-price">$29.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="8"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="8"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="8"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8amFja2V0fGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="Jacket" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">FashionStore</div>
                            <h3 class="product-title">Men's Denim Jacket - Classic Style</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="product-reviews">(87 reviews)</span>
                            </div>
                            <div class="product-price">$79.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="9"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="9"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="9"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <span class="product-badge">Sale</span>
                        <img src="https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHdvbWVuJTIwZmFzaGlvbnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="Women's Dress" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">FashionStore</div>
                            <h3 class="product-title">Women's Summer Dress - Floral Pattern</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="product-reviews">(153 reviews)</span>
                            </div>
                            <div class="product-price">$49.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="10"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="10"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="10"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Beauty Page Content -->
    <div id="beauty-page" class="page-content">
        <div class="container">
            <div class="category-page-header">
                <h2>Beauty</h2>
                <p>Discover premium beauty and skincare products</p>
            </div>
            
            <div class="products">
                <h2 class="section-title">Beauty Products</h2>
                <div class="product-grid">
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
                    </div>
                    
                    <div class="product-card">
                        <span class="product-badge">New</span>
                        <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2tpbmNhcmV8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="Makeup Kit" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">BeautyCorner</div>
                            <h3 class="product-title">Professional Makeup Kit - 12 Colors</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="product-reviews">(89 reviews)</span>
                            </div>
                            <div class="product-price">$69.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="11"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="11"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="11"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2tpbmNhcmV8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="Perfume" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">BeautyCorner</div>
                            <h3 class="product-title">Luxury Perfume - Floral Scent</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="product-reviews">(112 reviews)</span>
                            </div>
                            <div class="product-price">$89.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="12"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="12"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="12"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <span class="product-badge">Popular</span>
                        <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2tpbmNhremV8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="Hair Care" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">BeautyCorner</div>
                            <h3 class="product-title">Hair Care Kit - Shampoo & Conditioner</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="product-reviews">(134 reviews)</span>
                            </div>
                            <div class="product-price">$39.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="13"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="13"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="13"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sports Page Content -->
    <div id="sports-page" class="page-content">
        <div class="container">
            <div class="category-page-header">
                <h2>Sports</h2>
                <p>Discover sports equipment and activewear</p>
            </div>
            
            <div class="products">
                <h2 class="section-title">Sports Products</h2>
                <div class="product-grid">
                    <div class="product-card">
                        <span class="product-badge">Sale</span>
                        <img src="https://images.unsplash.com/photo-1532298229144-0ec0c57515c7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8YmljeWNsZXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="Bicycle" class="product-image">
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
                                <button class="add-to-cart" data-product="14"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="14"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="14"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8eW9nYSUyMG1hdHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="Yoga Mat" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">SportsWorld</div>
                            <h3 class="product-title">Premium Yoga Mat - Non-Slip Surface</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="product-reviews">(98 reviews)</span>
                            </div>
                            <div class="product-price">$39.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="15"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="15"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="15"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <span class="product-badge">New</span>
                        <img src="https://images.unsplash.com/photo-1593079831268-3381b0db4a77?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dGVubmlzJTIwcmFja2V0fGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="Tennis Racket" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">SportsWorld</div>
                            <h3 class="product-title">Professional Tennis Racket - Graphite</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="product-reviews">(63 reviews)</span>
                            </div>
                            <div class="product-price">$129.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="16"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="16"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="16"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1599058917765-a780eda07a3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8c3BvcnRzJTIwc2hvZXN8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="Running Shoes" class="product-image">
                        <div class="product-info">
                            <div class="product-vendor">SportsWorld</div>
                            <h3 class="product-title">Men's Running Shoes - Lightweight</h3>
                            <div class="product-rating">
                                <div class="product-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="product-reviews">(117 reviews)</span>
                            </div>
                            <div class="product-price">$89.99</div>
                            <div class="product-actions">
                                <button class="add-to-cart" data-product="17"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                <button class="view-product" data-product="17"><i class="fas fa-eye"></i> View</button>
                                <button class="wishlist" data-product="17"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
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
                    <div class="vendor-card">
                        <img src="https://images.unsplash.com/photo-1628563694622-5a76957fd09c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dGVjaCUyMGxvZ298ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="TechGadgets" class="vendor-avatar">
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
                        <img src="https://images.unsplash.com/photo-1545235617-9465d2a55698?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8ZmFzaGlvbiUyMGxvZ298ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="FashionStore" class="vendor-avatar">
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
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGhvbWUlMjBsb2dvfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt="HomeEssentials" class="vendor-avatar">
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
                    
                    <div class="vendor-card">
                        <img src="https://images.unsplash.com/photo-1634942536746-46b9a6de9231?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8YmVhdXR5JTIwbG9nb3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60" alt="BeautyCorner" class="vendor-avatar">
                        <h3 class="vendor-name">BeautyCorner</h3>
                        <div class="vendor-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>(147)</span>
                        </div>
                        <div class="vendor-products">165 Products</div>
                        <a href="#" class="view-store">Visit Store</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
