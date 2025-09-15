// Product database
// const products = [{
//         id: 1,
//         name: "Wireless Bluetooth Headphones with Noise Cancellation",
//         vendor: "TechGadgets",
//         price: 89.99,
//         image: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aGVhZHBob25lc3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
//         description: "Experience crystal clear sound with our premium wireless headphones. Featuring active noise cancellation technology, these headphones allow you to immerse yourself in your music without any distractions. With 30 hours of battery life and comfortable over-ear design, they're perfect for travel, work, or relaxation.",
//         features: ["Active Noise Cancellation", "30-hour Battery Life", "Bluetooth 5.0", "Comfortable Over-Ear Design", "Built-in Microphone"],
//         category: "electronics"
//     },
//     {
//         id: 2,
//         name: "Men's Casual Sneakers - Comfortable Walking Shoes",
//         vendor: "FashionStore",
//         price: 59.99,
//         image: "https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60",
//         description: "Step out in style with our comfortable men's casual sneakers. Designed for all-day comfort, these shoes feature a cushioned insole, flexible sole, and breathable material. Perfect for walking, casual outings, or everyday wear.",
//         features: ["Cushioned Insole", "Flexible Sole", "Breathable Material", "Durable Construction", "Modern Design"],
//         category: "fashion"
//     },
//     {
//         id: 3,
//         name: "Stainless Steel Kitchen Knife Set - 6 Pieces",
//         vendor: "HomeEssentials",
//         price: 129.99,
//         image: "https://images.unsplash.com/photo-1583778176475-6c7eb02c36be?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8a25pZmV8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60",
//         description: "Upgrade your kitchen with our premium stainless steel knife set. Crafted from high-quality German steel, these knives maintain their sharp edge and resist staining. The ergonomic handles provide comfort and control during food preparation.",
//         features: ["High-Quality German Steel", "Ergonomic Handles", "Dishwasher Safe", "6-Piece Set", "Wooden Block Included"],
//         category: "home"
//     },
//     {
//         id: 4,
//         name: "Organic Skincare Set - Face Cream & Serum",
//         vendor: "BeautyCorner",
//         price: 49.99,
//         image: "https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2tpbmNhcmV8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60",
//         description: "Pamper your skin with our organic skincare set. Formulated with natural ingredients, our face cream and serum work together to hydrate, rejuvenate, and protect your skin. Free from harsh chemicals, these products are suitable for all skin types.",
//         features: ["100% Organic Ingredients", "Hydrating Formula", "For All Skin Types", "Cruelty-Free", "Eco-Friendly Packaging"],
//         category: "beauty"
//     },
//     {
//         id: 5,
//         name: "Ultra-Thin Laptop with 15.6\" Display",
//         vendor: "TechGadgets",
//         price: 899.99,
//         image: "https://images.unsplash.com/photo-1541807084-5c52b6b3adef?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8bGFwdG9wfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60",
//         description: "Powerful and portable laptop with a stunning 15.6\" display. Perfect for work, entertainment, and creative projects. Features a fast processor, ample storage, and long battery life.",
//         features: ["15.6\" Full HD Display", "Fast Processor", "8GB RAM", "512GB SSD", "Long Battery Life"],
//         category: "electronics"
//     },
//     {
//         id: 6,
//         name: "Smart Watch with Fitness Tracking",
//         vendor: "TechGadgets",
//         price: 199.99,
//         image: "https://images.unsplash.com/photo-1572536147248-ac59a8abfa4b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fHNtYXJ0d2F0Y2h8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60",
//         description: "Stay connected and track your fitness goals with our advanced smartwatch. Monitor your heart rate, track workouts, receive notifications, and more.",
//         features: ["Fitness Tracking", "Heart Rate Monitor", "Notifications", "Water Resistant", "7-Day Battery"],
//         category: "electronics"
//     },
//     {
//         id: 7,
//         name: "True Wireless Earbuds with Charging Case",
//         vendor: "TechGadgets",
//         price: 79.99,
//         image: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aGVhZHBob25lc3xlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
//         description: "Enjoy wireless freedom with our true wireless earbuds. Featuring a compact charging case, these earbuds provide hours of listening time and crystal clear audio quality.",
//         features: ["True Wireless", "Charging Case", "Crystal Clear Audio", "Comfortable Fit", "Touch Controls"],
//         category: "electronics"
//     },
//     {
//         id: 8,
//         name: "Premium Cotton T-Shirt - Multiple Colors",
//         vendor: "FashionStore",
//         price: 29.99,
//         image: "https://images.unsplash.com/photo-1525507119028-ed4c629a60a3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8dCUyMHNoaXJ0fGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60",
//         description: "Soft and comfortable premium cotton t-shirt available in multiple colors. Perfect for everyday wear and casual occasions.",
//         features: ["100% Cotton", "Multiple Colors", "Soft Fabric", "Classic Fit", "Machine Washable"],
//         category: "fashion"
//     },
//     {
//         id: 9,
//         name: "Men's Denim Jacket - Classic Style",
//         vendor: "FashionStore",
//         price: 79.99,
//         image: "https://images.unsplash.com/photo-1591047139829-d91aecb6caea?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8amFja2V0fGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60",
//         description: "Classic denim jacket for men. Timeless style with a comfortable fit. Perfect for layering in various weather conditions.",
//         features: ["Classic Design", "Comfortable Fit", "Durable Denim", "Multiple Pockets", "Machine Washable"],
//         category: "fashion"
//     },
//     {
//         id: 10,
//         name: "Women's Summer Dress - Floral Pattern",
//         vendor: "FashionStore",
//         price: 49.99,
//         image: "https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHdvbWVuJTIwZmFzaGlvbnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
//         description: "Beautiful summer dress with a floral pattern. Lightweight and comfortable, perfect for warm weather and special occasions.",
//         features: ["Floral Pattern", "Lightweight Fabric", "Comfortable Fit", "Summer Style", "Machine Washable"],
//         category: "fashion"
//     },
//     {
//         id: 11,
//         name: "Professional Makeup Kit - 12 Colors",
//         vendor: "BeautyCorner",
//         price: 69.99,
//         image: "https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2tpbmNhcmV8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60",
//         description: "Professional makeup kit with 12 highly pigmented colors. Perfect for creating various looks from natural to dramatic.",
//         features: ["12 Colors", "Highly Pigmented", "Long Lasting", "Professional Quality", "Cruelty-Free"],
//         category: "beauty"
//     },
//     {
//         id: 12,
//         name: "Luxury Perfume - Floral Scent",
//         vendor: "BeautyCorner",
//         price: 89.99,
//         image: "https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2tpbmNhcmV8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60",
//         description: "Luxury perfume with a delicate floral scent. Long-lasting fragrance that evolves throughout the day.",
//         features: ["Floral Scent", "Long-Lasting", "Elegant Bottle", "Luxury Formula", "For All Occasions"],
//         category: "beauty"
//     },
//     {
//         id: 13,
//         name: "Hair Care Kit - Shampoo & Conditioner",
//         vendor: "BeautyCorner",
//         price: 39.99,
//         image: "https://images.unsplash.com/photo-1596462502278-27bfdc403348?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2tpbmNhcmV8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60",
//         description: "Complete hair care kit with nourishing shampoo and conditioner. Formulated to repair damage and add shine to your hair.",
//         features: ["Shampoo & Conditioner", "Nourishing Formula", "Repairs Damage", "Adds Shine", "For All Hair Types"],
//         category: "beauty"
//     },
//     {
//         id: 14,
//         name: "Mountain Bike - 21 Speed Gears",
//         vendor: "SportsWorld",
//         price: 299.99,
//         image: "https://images.unsplash.com/photo-1532298229144-0ec0c57515c7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8YmljeWNsZXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
//         description: "Durable mountain bike with 21 speed gears. Perfect for off-road adventures and daily commuting.",
//         features: ["21 Speed Gears", "Durable Frame", "Off-Road Tires", "Front Suspension", "Adjustable Seat"],
//         category: "sports"
//     },
//     {
//         id: 15,
//         name: "Premium Yoga Mat - Non-Slip Surface",
//         vendor: "SportsWorld",
//         price: 39.99,
//         image: "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8eW9nYSUyMG1hdHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=500&q=60",
//         description: "Premium yoga mat with non-slip surface. Provides cushioning and stability for your yoga practice.",
//         features: ["Non-Slip Surface", "Extra Cushioning", "Eco-Friendly Material", "Easy to Clean", "Portable"],
//         category: "sports"
//     },
//     {
//         id: 16,
//         name: "Professional Tennis Racket - Graphite",
//         vendor: "SportsWorld",
//         price: 129.99,
//         image: "https://images.unsplash.com/photo-1593079831268-3381b0db4a77?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dGVubmlzJTIwcmFja2V0fGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60",
//         description: "Professional tennis racket made from graphite. Lightweight yet powerful, perfect for competitive play.",
//         features: ["Graphite Construction", "Lightweight", "Powerful", "Precision Stringing", "Comfortable Grip"],
//         category: "sports"
//     },
//     {
//         id: 17,
//         name: "Men's Running Shoes - Lightweight",
//         vendor: "SportsWorld",
//         price: 89.99,
//         image: "https://images.unsplash.com/photo-1599058917765-a780eda07a3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8c3BvcnRzJTIwc2hvZXN8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60",
//         description: "Lightweight running shoes for men. Designed for comfort and performance during runs and workouts.",
//         features: ["Lightweight", "Breathable", "Cushioned Sole", "Flexible", "Durable"],
//         category: "sports"
//     }
// ];

// Cart functionality
// let cart = [];
// const cartCount = document.querySelector('.cart-count');
// const cartDropdown = document.getElementById('cart-dropdown');

// Navigation functionality
const pageContents = document.querySelectorAll('.page-content');
const navLinks = document.querySelectorAll('.nav-menu a, .footer-links a');
const homeLink = document.getElementById('home-link');

// Search functionality
const searchInput = document.getElementById('search-input');
const searchButton = document.getElementById('search-button');

// Initialize the application
// document.addEventListener('DOMContentLoaded', function () {
//     initCart();
//     initNavigation();
//     initSearch();
//     initProductInteractions();

//     // updateCartUI();
//     // Initial render
//     renderCheckout();
// });

// function initCart() {
//     updateCartUI();
// }

function initNavigation() {
    // Navigation links
    // navLinks.forEach(link => {
    //     link.addEventListener('click', function(e) {
    //         e.preventDefault();
    //         const page = this.getAttribute('data-page');
    //         if (page) {
    //             showPage(page);
    //         }
    //     });
    // });

    // // Home logo link
    // homeLink.addEventListener('click', function(e) {
    //     e.preventDefault();
    //     showPage('home');
    // });

    // Category cards
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(card => {
        card.addEventListener('click', function () {
            const category = this.getAttribute('data-category');
            if (category) {
                showPage(category);
            }
        });
    });
}

function initSearch() {
    searchButton.addEventListener('click', function () {
        performSearch();
    });

    searchInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
}

function initProductInteractions() {
    // Add to cart functionality
    document.addEventListener('click', function (e) {


        // if (e.target.classList.contains('add-to-cart') || e.target.closest('.add-to-cart')) {
        //     const button = e.target.classList.contains('add-to-cart') ? e.target : e.target.closest('.add-to-cart');
        //     const productId = parseInt(button.getAttribute('data-product'));
        //     addToCart(productId);
        // }

        // Wishlist functionality
        if (e.target.classList.contains('wishlist') || e.target.closest('.wishlist')) {
            const button = e.target.classList.contains('wishlist') ? e.target : e.target.closest('.wishlist');
            toggleWishlist(button);
        }

        // View product functionality
        // if (e.target.classList.contains('view-product') || e.target.closest('.view-product')) {
        //     const button = e.target.classList.contains('view-product') ? e.target : e.target.closest('.view-product');
        //     const productId = parseInt(button.getAttribute('data-product'));
        //     console.log('yes2');

        //     showProductModal(productId);
        // }


    });

    // Close modal functionality
    const closeModal = document.querySelector('.close-modal');
    closeModal.addEventListener('click', function () {
        document.getElementById('productModal').style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === document.getElementById('productModal')) {
            document.getElementById('productModal').style.display = 'none';
        }
    });
}

function showPage(pageName) {
    // Hide all pages
    pageContents.forEach(page => {
        page.classList.remove('active');
    });

    // Show the requested page
    const pageId = `${pageName}-page`;
    const pageElement = document.getElementById(pageId);

    if (pageElement) {
        pageElement.classList.add('active');
        window.scrollTo(0, 0);
    } else {
        // Fallback to home page if page not found
        document.getElementById('home-page').classList.add('active');
    }
}

function performSearch() {
    const searchTerm = searchInput.value.trim().toLowerCase();

    if (searchTerm) {
        // Show search results page
        showPage('search-results');

        // Update search term display
        document.getElementById('search-term').textContent = `"${searchTerm}"`;

        // Filter products based on search term
        const filteredProducts = products.filter(product =>
            product.name.toLowerCase().includes(searchTerm) ||
            product.vendor.toLowerCase().includes(searchTerm) ||
            product.category.toLowerCase().includes(searchTerm)
        );

        // Display search results
        const resultsGrid = document.getElementById('search-results-grid');
        resultsGrid.innerHTML = '';

        if (filteredProducts.length > 0) {
            filteredProducts.forEach(product => {
                resultsGrid.innerHTML += createProductCard(product);
            });
        } else {
            resultsGrid.innerHTML = `
                        <div class="empty-cart-message">
                            <i class="fas fa-search"></i>
                            <p>No products found for "${searchTerm}"</p>
                            <p>Try different keywords or browse our categories</p>
                        </div>
                    `;
        }
    }
}

function createProductCard(product) {
    return `
                <div class="product-card">
                    <img src="${product.image}" alt="${product.name}" class="product-image">
                    <div class="product-info">
                        <div class="product-vendor">${product.vendor}</div>
                        <h3 class="product-title">${product.name}</h3>
                        <div class="product-rating">
                            <div class="product-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="product-reviews">(128 reviews)</span>
                        </div>
                        <div class="product-price">$${product.price.toFixed(2)}</div>
                        <div class="product-actions">
                            <button class="add-to-cart" data-product="${product.id}"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                            <button class="view-product" data-product="${product.id}"><i class="fas fa-eye"></i> View</button>
                            <button class="wishlist" data-product="${product.id}"><i class="far fa-heart"></i></button>
                        </div>
                    </div>
                </div>
            `;
}

// function addToCart(productId) {
//     const product = products.find(p => p.id === productId);

//     if (product) {
//         // Check if product is already in cart
//         const existingItem = cart.find(item => item.product.id === productId);

//         if (existingItem) {
//             existingItem.quantity += 1;
//         } else {
//             cart.push({
//                 product: product,
//                 quantity: 1
//             });
//         }

//         updateCartUI();

//         // Show feedback
//         const originalText = event.target.innerHTML;
//         event.target.innerHTML = '<i class="fas fa-check"></i> Added!';
//         event.target.style.backgroundColor = 'var(--success)';

//         setTimeout(() => {
//             event.target.innerHTML = originalText;
//             event.target.style.backgroundColor = '';
//         }, 2000);

//         console.log(`Product ${productId} added to cart`);
//     }
// }

// function updateCartUI() {
//     // Update cart count
//     const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
//     cartCount.textContent = totalItems;

//     // Update cart dropdown
//     if (cart.length > 0) {
//         let cartHTML = '';
//         let total = 0;

//         cart.forEach(item => {
//             const itemTotal = item.product.price * item.quantity;
//             total += itemTotal;

//             cartHTML += `
//                         <div class="cart-item">
//                             <img src="${item.product.image}" alt="${item.product.name}" class="cart-item-image">
//                             <div class="cart-item-details">
//                                 <div class="cart-item-title">${item.product.name}</div>
//                                 <div class="cart-item-price">$${item.product.price.toFixed(2)} x ${item.quantity}</div>
//                             </div>
//                         </div>
//                     `;
//         });

//         cartHTML += `
//                     <div class="cart-total">
//                         <span>Total:</span>
//                         <span>$${total.toFixed(2)}</span>
//                     </div>
//                     <a href="#" class="view-cart">View Cart & Checkout</a>
//                 `;

//         cartDropdown.innerHTML = cartHTML;
//     } else {
//         cartDropdown.innerHTML = `
//                     <div class="empty-cart-message">
//                         <i class="fas fa-shopping-cart"></i>
//                         <p>Your cart is empty</p>
//                     </div>
//                 `;
//     }
// }

function toggleWishlist(button) {
    const icon = button.querySelector('i');

    if (icon.classList.contains('far')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
        icon.style.color = 'var(--accent)';
        button.classList.add('active');

        const productId = button.getAttribute('data-product');
        console.log(`Product ${productId} added to wishlist`);
    } else {
        icon.classList.remove('fas');
        icon.classList.add('far');
        icon.style.color = '';
        button.classList.remove('active');

        const productId = button.getAttribute('data-product');
        console.log(`Product ${productId} removed from wishlist`);
    }
}


// Initialize cart array from localStorage
let cart = JSON.parse(localStorage.getItem('marketplace-cart')) || [];

// DOM references
const cartCount = document.querySelector('.cart-count');
const cartDropdown = document.getElementById('cart-dropdown');
const checkoutItemsContainer = document.getElementById('checkout-items');
const checkoutTotalEl = document.getElementById('checkout-total');
const bankTotal = document.getElementById('transfer-total');

// Initialize the application
document.addEventListener('DOMContentLoaded', function () {
    initNavigation();
    initSearch();
    initProductInteractions();
    updateCartUI();
    renderCheckout();
});

// Handle global clicks
document.addEventListener('click', function (e) {
    // Add to cart
    if (e.target.classList.contains('add-to-cart') || e.target.closest('.add-to-cart')) {
        const clickedButton = e.target.closest('.add-to-cart');
        const productId = parseInt(clickedButton.getAttribute('data-product-id'));

        const product = {
            id: productId,
            name: clickedButton.getAttribute('data-name'),
            price: parseFloat(clickedButton.getAttribute('data-price')),
            image: clickedButton.getAttribute('data-image'),
            vendor: clickedButton.getAttribute('data-vendor')
        };

        addToCart(product, clickedButton);
    }

    // Remove from cart (dropdown + checkout ❌ button)
    if (e.target.classList.contains('cart-item-remove')) {
        const productId = parseInt(e.target.getAttribute('data-product-id'));
        removeFromCart(productId);
        updateCartUI();


    }
});

// Add item to cart
function addToCart(product, button) {
    const existingItem = cart.find(item => item.product.id === product.id);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ product, quantity: 1 });
    }

    saveCart();
    updateCartUI();
    renderCheckout();

    // Feedback on button
    button.innerHTML = '<i class="fas fa-check"></i> Added!';
    button.style.backgroundColor = 'var(--success)';
    button.disabled = true;
}

// Remove item from cart (entirely or decrease quantity)
function removeFromCart(productId) {
    cart = cart.filter(item => item.product.id !== productId);
    saveCart();
    updateCartUI();
    renderCheckout();
}

// Update cart UI (top-right mini cart dropdown)
function updateCartUI() {
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    cartCount.textContent = totalItems;

    // Update buttons
    cart.forEach(item => {
        document.querySelectorAll(`.add-to-cart[data-product-id="${item.product.id}"]`).forEach(btn => {
            btn.innerHTML = '<i class="fas fa-check"></i> Added!';
            btn.style.backgroundColor = 'var(--success)';
            btn.disabled = true;
        });
    });

    if (cart.length > 0) {
        let cartHTML = '';
        let total = 0;

        cart.forEach(item => {
            const itemTotal = item.product.price * item.quantity;
            total += itemTotal;

            cartHTML += `
                <div class="cart-item">
                    <img src="${item.product.image}" alt="${item.product.name}" class="cart-item-image">
                    <div class="cart-item-details">
                        <div class="cart-item-title">${item.product.name}</div>
                        <div class="cart-item-price">₦${item.product.price.toFixed(2)} x ${item.quantity}</div>
                    </div>
                </div>
                `;
                    // <span class="cart-item-remove" data-product-id="${item.product.id}">&times;</span>
        });

        cartHTML += `
            <div class="cart-total">
                <span>Total:</span>
                <span>₦${total.toFixed(2)}</span>
            </div>
            <a href="/checkout" class="view-cart">View Cart & Checkout</a>
        `;

        cartDropdown.innerHTML = cartHTML;
    } else {
        cartDropdown.innerHTML = `
            <div class="empty-cart-message">
                <i class="fas fa-shopping-cart"></i>
                <p>Your cart is empty</p>
            </div>
        `;
    }
}

// Save to localStorage
function saveCart() {
    localStorage.setItem('marketplace-cart', JSON.stringify(cart));
}

// Render checkout page cart items
function renderCheckout() {
    if (!checkoutItemsContainer) return; // safety if not on checkout page

    checkoutItemsContainer.innerHTML = '';
    let total = 0;

    cart.forEach(item => {
        const itemTotal = item.product.price * item.quantity;
        total += itemTotal;

        const itemEl = document.createElement('div');
        itemEl.classList.add('checkout-item');
        itemEl.innerHTML = `
            <img src="${item.product.image}" alt="${item.product.name}" class="checkout-item-image">
            <div class="checkout-item-details">
                <p class="checkout-item-title">${item.product.name}</p>
                <p class="checkout-item-price">₦${item.product.price.toFixed(2)}</p>
            </div>
            <div class="cart-modal-item-quantity">
                <button class="quantity-btn decrease" data-id="${item.product.id}">-</button>
                <span class="quantity-value">${item.quantity}</span>
                <button class="quantity-btn increase" data-id="${item.product.id}">+</button>
            </div>
            <div class="cart-modal-item-quantity" style="margin-left: 2rem;cursor: pointer;">
                <span class="cart-item-remove" data-product-id="${item.product.id}">❌</span>
            </div>
        `;
        checkoutItemsContainer.appendChild(itemEl);
    });

    checkoutTotalEl.textContent = `₦${total.toFixed(2)}`;
    bankTotal.textContent = `₦${total.toFixed(2)}`;
}

// Update quantity (+ / - buttons)
if (checkoutItemsContainer) {
    checkoutItemsContainer.addEventListener('click', e => {
        if (e.target.classList.contains('increase')) {
            const id = parseInt(e.target.dataset.id);
            updateCart(id, 1);
        }
        if (e.target.classList.contains('decrease')) {
            const id = parseInt(e.target.dataset.id);
            updateCart(id, -1);
        }
    });
}

function updateCart(productId, delta) {
    const item = cart.find(i => i.product.id === productId);
    if (!item) return;

    item.quantity += delta;
    if (item.quantity < 1) {
        cart = cart.filter(i => i.product.id !== productId);
    }

    saveCart();
    renderCheckout();
    updateCartUI();
}

