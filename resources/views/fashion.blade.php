@extends('layouts.nav')

@section('content')


    <!-- Fashion Page Content -->
     <br>
    <div id="fashion-page">
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
@endsection