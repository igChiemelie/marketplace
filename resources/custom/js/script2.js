document.addEventListener('DOMContentLoaded', function () {
    // Set current date
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };
    const currentDateEl = document.getElementById('current-date');
    if (currentDateEl) {
        currentDateEl.textContent = now.toLocaleDateString('en-US', options);
    }

    // Initialize cart
    let cart = JSON.parse(localStorage.getItem('marketHubCart')) || [];
    updateCartCount();
    renderCartItems();

    // Check for saved dark mode preference
    const darkModeEnabled = localStorage.getItem('darkMode') === 'true';
    if (darkModeEnabled) {
        document.body.classList.add('dark-mode');
        const toggleEl = document.getElementById('dark-mode-toggle');
        if (toggleEl && toggleEl.type === "checkbox") {
            toggleEl.checked = true;
        }
    }

    // Sidebar toggle for mobile
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');

    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('open');
        });
    }

    // Sidebar collapse toggle for desktop
    const toggleSidebarBtn = document.getElementById('toggle-sidebar');
    const mainContent = document.getElementById('main-content');

    if (toggleSidebarBtn && sidebar && mainContent) {
        toggleSidebarBtn.addEventListener('click', function () {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');

            // Change icon based on state
            const icon = toggleSidebarBtn.querySelector('i');
            if (sidebar.classList.contains('collapsed')) {
                icon.className = 'fas fa-chevron-right';
            } else {
                icon.className = 'fas fa-chevron-left';
            }
        });
    }

    // User dropdown toggle
    const userProfile = document.getElementById('user-profile');
    const userDropdown = document.getElementById('user-dropdown');

    if (userProfile && userDropdown) {
        userProfile.addEventListener('click', function (e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });

        // Close dropdown when clicking elsewhere
        document.addEventListener('click', function () {
            userDropdown.classList.remove('show');
        });
    }

    // ✅ Tab navigation only for dropdown items with data-tab
    const tabLinks = document.querySelectorAll('.dropdown-item[data-tab]');
    const tabContents = document.querySelectorAll('.tab-content');

    tabLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const tabId = this.getAttribute('data-tab');

            // Remove active class from all tabs
            tabLinks.forEach(l => l.classList.remove('active'));
            tabContents.forEach(t => t.classList.remove('active'));

            // Add active class to current tab
            this.classList.add('active');
            const activeTab = document.getElementById(tabId);
            if (activeTab) activeTab.classList.add('active');

            // Close sidebar on mobile
            if (window.innerWidth < 992 && sidebar) {
                sidebar.classList.remove('open');
            }

            // Close dropdown
            if (userDropdown) userDropdown.classList.remove('show');
        });
    });

    // Product tabs
    const productTabs = document.querySelectorAll('[data-product-tab]');
    productTabs.forEach(tab => {
        tab.addEventListener('click', function () {
            productTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const price = parseFloat(this.getAttribute('data-price'));
            const image = this.getAttribute('data-image');

            addToCart(id, name, price, image);

            // Show confirmation
            // this.innerHTML = '<i class="fas fa-check"></i> Added to Cart';
            this.classList.add('btn-success');

            setTimeout(() => {
                alert(`"${name}" has been added to your cart.`);
                this.classList.remove('btn-success');
            }, 1500);
        });
    });

    // Cart icon click → open cart tab
    const cartIcon = document.getElementById('cart-icon');
    if (cartIcon) {
        cartIcon.addEventListener('click', function () {
            tabLinks.forEach(l => l.classList.remove('active'));
            tabContents.forEach(t => t.classList.remove('active'));

            const cartTabLink = document.querySelector('[data-tab="cart"]');
            if (cartTabLink) cartTabLink.classList.add('active');
            const cartTabContent = document.getElementById('cart');
            if (cartTabContent) cartTabContent.classList.add('active');
        });
    }

    // Clear cart button
    const clearCartBtn = document.getElementById('clear-cart-btn');
    if (clearCartBtn) {
        clearCartBtn.addEventListener('click', function () {
            if (cart.length > 0 && confirm('Are you sure you want to clear your cart?')) {
                cart = [];
                updateCart();
            }
        });
    }

    //Edit Product Modal
    const editProductBtns = document.querySelectorAll('.edit-product-btn');
    const editProductModal = document.getElementById('edit-product-modal');
    const closeEditModalBtn = document.getElementById('close-edit-modal');
   const closeEditModalX = document.querySelector('#edit-product-modal .close');

    // Add Product Modal
    const addProductBtn = document.getElementById('add-product-btn');
    const addProductModal = document.getElementById('add-product-modal');
    const closeModalBtn = document.getElementById('close-modal');
    const closeModalX = document.querySelector('.close');
    const saveProductBtn = document.getElementById('save-product');

    if (addProductBtn && addProductModal) {
        addProductBtn.addEventListener('click', function () {
            addProductModal.style.display = 'flex';
        });
    }

    if (closeModalBtn && addProductModal) {
        closeModalBtn.addEventListener('click', function () {
            addProductModal.style.display = 'none';
        });
    }

    if (closeModalX && addProductModal) {
        closeModalX.addEventListener('click', function () {
            addProductModal.style.display = 'none';
        });
    }

    if (saveProductBtn && addProductModal) {
        saveProductBtn.addEventListener('click', function () {
            const productName = document.getElementById('product-name').value;
            const productPrice = document.getElementById('product-price').value;

            if (productName && productPrice) {
                alert(`Product "${productName}" has been added successfully!`);
                document.getElementById('add-product-form').reset();
                addProductModal.style.display = 'none';
            } else {
                alert('Please fill in all required fields.');
            }
        });
    }

    // Profile form submission
    const profileForm = document.getElementById('profile-form');
    if (profileForm) {
        profileForm.addEventListener('submit', function (e) {
            e.preventDefault();
            alert('Profile updated successfully!');
        });
    }

    // Close modal if clicked outside
    window.addEventListener('click', function (e) {
        if (addProductModal && e.target === addProductModal) {
            addProductModal.style.display = 'none';
        }
    });

    // Dark mode toggle
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('change', function () {
            if (this.checked) {
                document.body.classList.add('dark-mode');
                localStorage.setItem('darkMode', 'true');
            } else {
                document.body.classList.remove('dark-mode');
                localStorage.setItem('darkMode', 'false');
            }
        });
    }

    // ====== Cart functions ======
    function addToCart(id, name, price, image) {
        const existingItem = cart.find(item => item.id === id);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({ id, name, price, image, quantity: 1 });
        }
        updateCart();
    }

    function updateCart() {
        localStorage.setItem('marketHubCart', JSON.stringify(cart));
        updateCartCount();
        renderCartItems();
    }

    function updateCartCount() {
        const cartCount = document.getElementById('cart-count');
        if (cartCount) {
            const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            cartCount.textContent = totalItems;
        }
    }

    function renderCartItems() {
        const cartContainer = document.getElementById('cart-items-container');
        const emptyCartMessage = document.getElementById('empty-cart-message');
        const cartItemsCount = document.getElementById('cart-items-count');
        const checkoutBtn = document.getElementById('checkout-btn');

        if (!cartContainer) return;

        if (cart.length === 0) {
            if (emptyCartMessage) emptyCartMessage.style.display = 'block';
            if (cartItemsCount) cartItemsCount.textContent = '0 items';
            if (checkoutBtn) checkoutBtn.disabled = true;
            return;
        }

        if (emptyCartMessage) emptyCartMessage.style.display = 'none';

        const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
        if (cartItemsCount) cartItemsCount.textContent = `${totalItems} ${totalItems === 1 ? 'item' : 'items'}`;

        let cartHTML = '';
        let subtotal = 0;

        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            cartHTML += `
                <div class="cart-item" data-id="${item.id}">
                    <div class="cart-item-image">
                        <img src="${item.image}" alt="${item.name}">
                    </div>
                    <div class="cart-item-details">
                        <div class="cart-item-title">${item.name}</div>
                        <div class="cart-item-price">$${item.price.toFixed(2)}</div>
                        <div class="cart-item-actions">
                            <div class="quantity-control">
                                <button class="quantity-btn decrease-qty" data-id="${item.id}">-</button>
                                <span>${item.quantity}</span>
                                <button class="quantity-btn increase-qty" data-id="${item.id}">+</button>
                            </div>
                            <div class="cart-item-remove" data-id="${item.id}">
                                <i class="fas fa-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        cartContainer.innerHTML = cartHTML;

        const shipping = subtotal > 0 ? 9.99 : 0;
        const tax = subtotal * 0.08;
        const total = subtotal + shipping + tax;

        const subEl = document.getElementById('cart-subtotal');
        const shipEl = document.getElementById('cart-shipping');
        const taxEl = document.getElementById('cart-tax');
        const totalEl = document.getElementById('cart-total');

        if (subEl) subEl.textContent = `$${subtotal.toFixed(2)}`;
        if (shipEl) shipEl.textContent = `$${shipping.toFixed(2)}`;
        if (taxEl) taxEl.textContent = `$${tax.toFixed(2)}`;
        if (totalEl) totalEl.textContent = `$${total.toFixed(2)}`;

        if (checkoutBtn) checkoutBtn.disabled = false;

        // Quantity buttons
        document.querySelectorAll('.increase-qty').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const item = cart.find(item => item.id === id);
                if (item) {
                    item.quantity += 1;
                    updateCart();
                }
            });
        });

        document.querySelectorAll('.decrease-qty').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const item = cart.find(item => item.id === id);
                if (item) {
                    item.quantity -= 1;
                    if (item.quantity === 0) {
                        cart = cart.filter(item => item.id !== id);
                    }
                    updateCart();
                }
            });
        });

        document.querySelectorAll('.cart-item-remove').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                cart = cart.filter(item => item.id !== id);
                updateCart();
            });
        });
    }
});

