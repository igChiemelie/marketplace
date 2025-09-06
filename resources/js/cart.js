import Swal from 'sweetalert2';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
    const cartForms = document.querySelectorAll('.cart-form');

    cartForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const url = this.action;
            const formData = new FormData(this);

            axios.post(url, formData)
                .then(response => {
                    if (response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to cart!',
                            text: response.data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        updateCartCount(response.data.cartCount);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                });
        });
    });

    function updateCartCount(count) {
        const cartCountElement = document.getElementById('cart-count');
        if (cartCountElement) {
            cartCountElement.textContent = count;
        }
    }

    const cartPreview = document.querySelector('.cart-preview');
    const cartDropdown = document.getElementById('cart-dropdown');

    cartPreview.addEventListener('mouseenter', function () {
        const url = this.dataset.cartItemsUrl;
        axios.get(url)
            .then(response => {
                const items = response.data;
                cartDropdown.innerHTML = '';

                if (items.length === 0) {
                    cartDropdown.innerHTML = '<div class="empty-cart-message"><i class="fas fa-shopping-cart"></i><p>Your cart is empty</p></div>';
                } else {
                    items.forEach(item => {
                        const cartItem = document.createElement('div');
                        cartItem.classList.add('cart-item');
                        cartItem.innerHTML = `
                            <div class="cart-item-info">
                                <span class="cart-item-title">${item.product.name}</span>
                                <span class="cart-item-quantity">x ${item.quantity}</span>
                            </div>
                            <span class="cart-item-price">$${item.product.price * item.quantity}</span>
                        `;
                        cartDropdown.appendChild(cartItem);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching cart items:', error);
            });
    });
});
