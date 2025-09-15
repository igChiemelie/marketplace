@extends('layouts.nav')

@section('content')
    <!-- Vendors Page Content -->
    <br>
    <div id="vendors-page">
        <div class="container">
            <div class="category-page-header">
                <h2>All Vendors</h2>
                <p>Discover our trusted vendors and their stores</p>
            </div>

            <div class="vendor-grid">
                @forelse ($vendors as $vendor)
                    <div class="vendor-card">

                        @if($vendor->shop_logo)
                            <img src="{{ asset('storage/' . $vendor->shop_logo) }}" alt="{{ $vendor->name }}" class="vendor-avatar">     
                        @else
                            <img src="https://images.unsplash.com/photo-1628563694622-5a76957fd09c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dGVjaCUyMGxvZ298ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="TechGadgets" class="vendor-avatar">

                        @endif
                        <h3 class="vendor-name">{{ $vendor->name }}</h3>
                        <div class="vendor-rating">
                            {{-- @for ($i = 0; $i < floor($vendor->rating); $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            @if ($vendor->rating - floor($vendor->rating) >= 0.5)
                                <i class="fas fa-star-half-alt"></i>
                            @endif
                            @for ($i = ceil($vendor->rating); $i < 5; $i++)
                                <i class="far fa-star"></i>
                            @endfor --}}
                            {{-- <span>({{ $vendor->reviews_count }})</span> --}}

                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            {{-- <i class="fas fa-star"></i> --}}
                            <i class="fas fa-star-half-alt"></i>
                            <span>({{ $vendor->products_count }})</span>
                            
                        </div>
                        <div class="vendor-products">{{ $vendor->products_count }} Products</div>
                        <a href="{{ route('vendors.shop', $vendor->shop_slug) }}" class="view-store">Visit Store</a>
                    </div>
                @empty
                    <p>No vendors available.</p>
                @endforelse
            </div>
        </div>


     

        <div class="pagination-wrapper">
            {{ $vendors->links('vendor-pagination') }}
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
