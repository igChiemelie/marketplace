@extends('layouts.nav')

@section('content')


    <!-- Vendors Page Content -->
     <br>
    <div id="vendors-page">
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