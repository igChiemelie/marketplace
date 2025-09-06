@extends('layouts.nav')

@section('content')


    <!-- Beauty Page Content -->
     <br>
    <div id="beauty-page">
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

@endsection