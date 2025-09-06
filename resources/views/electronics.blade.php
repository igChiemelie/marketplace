@extends('layouts.nav')

@section('content')



    <!-- Electronics Page Content -->
     <br>
    <div id="electronics-page">
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

   
@endsection
