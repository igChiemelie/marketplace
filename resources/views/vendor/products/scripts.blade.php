<script>
document.addEventListener('DOMContentLoaded', function () {

    // -------------------------------
    // IMAGE PREVIEW FOR ADD PRODUCT
    // -------------------------------
    const addImageInput = document.querySelector('#add-product-form input[name="images[]"]');
    if (addImageInput) {
        addImageInput.addEventListener('change', function(event) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = "";

            [...event.target.files].forEach(file => {
                if (!file.type.startsWith("image/")) return;

                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.style.width = "120px";
                    img.style.height = "120px";
                    img.style.objectFit = "cover";
                    img.style.border = "1px solid #ccc";
                    img.style.borderRadius = "6px";
                    img.style.margin = "5px";
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    }

    // -------------------------------
    // OPEN ADD PRODUCT MODAL
    // -------------------------------
    const addProductModal = document.getElementById('add-product-modal');
    document.getElementById('add-product-btn').addEventListener('click', () => {
        addProductModal.style.display = 'block';
    });
    document.querySelector('#add-product-modal .close').addEventListener('click', () => {
        addProductModal.style.display = 'none';
    });
    document.getElementById('close-modal').addEventListener('click', () => {
        addProductModal.style.display = 'none';
    });

    // -------------------------------
    // SAVE PRODUCT (AJAX)
    // -------------------------------
    document.getElementById('save-product').addEventListener('click', function () {
        let form = document.getElementById('add-product-form');
        let formData = new FormData(form);

        fetch("{{ route('vendor.products.store') }}", {
            method: "POST",
            headers: { 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                Swal.fire({ icon: 'error', title: 'Oops...', text: data.error, confirmButtonColor: '#d33' });
            } else {
                Swal.fire({ icon: 'success', title: 'Success!', text: data.message, timer: 2000, showConfirmButton: false });
                form.reset();
                document.getElementById('image-preview').innerHTML = "";
                addProductModal.style.display = 'none';

                // Dynamically add new product to the grid
                let grid = document.querySelector('.product-grid');
                let imagesHtml = data.product.images && data.product.images.length
                    ? `<img src="/storage/${data.product.images[0].image_path}" alt="${data.product.name}">`
                    : `<img src="{{ asset('images/no-image.png') }}" alt="No Image">`;

                grid.insertAdjacentHTML('afterbegin', `
                    <div class="product-card">
                        <div class="product-image">${imagesHtml}</div>
                        <div class="product-info">
                            <div class="product-title">${data.product.name}</div>
                            <div class="product-price">₦${parseFloat(data.product.price).toFixed(2)}</div>
                            <div class="product-meta">
                                <span>${data.product.quantity ?? 0} in stock</span>
                                <span>0 sold</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="action-buttons">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-warning edit-product-btn" data-id="${data.product.id}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger delete-product-btn" data-id="${data.product.id}"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                `);

                bindDynamicButtons(); // rebind edit/delete buttons
            }
        })
        .catch(err => {
            Swal.fire({ icon: 'error', title: 'Error', text: err, confirmButtonColor: '#d33' });
        });
    });

    // -------------------------------
    // EDIT PRODUCT MODAL
    // -------------------------------
    const editModal = document.getElementById('edit-product-modal');
    const editForm = document.getElementById('edit-product-form');
    let currentProductId = null;

    

    function bindDynamicButtons() {
        // Edit buttons
        document.querySelectorAll('.edit-product-btn').forEach(btn => {
            btn.onclick = function() {
                currentProductId = this.dataset.id;

                fetch(`/vendor/products/${currentProductId}/edit`)
                    .then(res => res.json())
                    .then(data => {
                        const p = data.product;
                        editForm.querySelector('#edit-product-name').value = p.name;
                        editForm.querySelector('#edit-product-description').value = p.description;
                        editForm.querySelector('#edit-product-price').value = p.price;
                        editForm.querySelector('#edit-product-stock').value = p.quantity;
                        editForm.querySelector('#edit-product-category').value = p.category_id || '';
                        editModal.style.display = 'block';
                    });
            };
        });

        // Delete buttons
        document.querySelectorAll('.delete-product-btn').forEach(btn => {
            btn.onclick = function() {
                const productId = this.dataset.id;
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/vendor/products/${productId}`, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value },
                            body: new URLSearchParams({ _method: 'DELETE' })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({ icon: 'success', title: 'Deleted!', text: data.message, timer: 2000, showConfirmButton: false });
                                document.querySelector(`.delete-product-btn[data-id="${productId}"]`).closest('.product-card').remove();
                            }
                        });
                    }
                });
            };
        });
    }

    bindDynamicButtons(); // initial bind

    // Close edit modal
    document.getElementById('close-edit-modal').addEventListener('click', () => { editModal.style.display = 'none'; });

    // Update product
    document.getElementById('update-product').addEventListener('click', function () {
        let formData = new FormData(editForm);
        formData.append('_method', 'PUT');

        fetch(`/vendor/products/${currentProductId}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire({ icon: 'success', title: 'Updated!', text: data.message, timer: 2000, showConfirmButton: false });
                editModal.style.display = 'none';

                const card = document.querySelector(`.edit-product-btn[data-id="${currentProductId}"]`).closest('.product-card');
                card.querySelector('.product-title').textContent = data.product.name;
                card.querySelector('.product-price').textContent = '₦' + parseFloat(data.product.price).toFixed(2);
                card.querySelector('.product-meta span:first-child').textContent = (data.product.quantity ?? 0) + ' in stock';
                if (data.product.images && data.product.images.length) {
                    card.querySelector('.product-image img').src = '/storage/' + data.product.images[0].image_path;
                }
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: data.message || 'Something went wrong' });
            }
        });
    });

});
</script>
