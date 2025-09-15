 document.addEventListener('DOMContentLoaded', function () {
     // Set current date
     const now = new Date();
     const options = {
         weekday: 'long',
         year: 'numeric',
         month: 'short',
         day: 'numeric'
     };
     document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', options);

     // Check for saved dark mode preference
     const darkModeEnabled = localStorage.getItem('darkMode') === 'true';
     if (darkModeEnabled) {
         document.body.classList.add('dark-mode');
         document.getElementById('dark-mode-toggle').checked = true;
     }

     // Sidebar toggle for mobile
     const menuToggle = document.getElementById('menu-toggle');
     const sidebar = document.getElementById('sidebar');

     menuToggle.addEventListener('click', function () {
         sidebar.classList.toggle('open');
     });

     // Sidebar collapse toggle for desktop
     const toggleSidebarBtn = document.getElementById('toggle-sidebar');
     const mainContent = document.getElementById('main-content');

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

     // User dropdown toggle
     const userProfile = document.getElementById('user-profile');
     const userDropdown = document.getElementById('user-dropdown');

     userProfile.addEventListener('click', function (e) {
         e.stopPropagation();
         userDropdown.classList.toggle('show');
     });

     // Close dropdown when clicking elsewhere
     document.addEventListener('click', function () {
         userDropdown.classList.remove('show');
     });

     // Tab navigation
     // const tabLinks = document.querySelectorAll('.sidebar-menu a, .dropdown-item[data-tab]');
     // const tabContents = document.querySelectorAll('.tab-content');

     // tabLinks.forEach(link => {
     //     link.addEventListener('click', function(e) {
     //         e.preventDefault();

     //         const tabId = this.getAttribute('data-tab');

     //         // Remove active class from all tabs
     //         tabLinks.forEach(l => l.classList.remove('active'));
     //         tabContents.forEach(t => t.classList.remove('active'));

     //         // Add active class to current tab
     //         this.classList.add('active');
     //         document.getElementById(tabId).classList.add('active');

     //         // Close sidebar on mobile after selection
     //         if (window.innerWidth < 992) {
     //             sidebar.classList.remove('open');
     //         }

     //         // Close dropdown if it's open
     //         userDropdown.classList.remove('show');
     //     });
     // });

     // CMS tabs
     const cmsTabs = document.querySelectorAll('[data-cms-tab]');

     cmsTabs.forEach(tab => {
         tab.addEventListener('click', function () {
             cmsTabs.forEach(t => t.classList.remove('active'));
             this.classList.add('active');
             // In a real app, this would filter CMS content
         });
     });

     // Dark mode toggle
    //  const darkModeToggle = document.getElementById('dark-mode-toggle');

    //  darkModeToggle.addEventListener('change', function () {
    //      if (this.checked) {
    //          document.body.classList.add('dark-mode');
    //          localStorage.setItem('darkMode', 'true');
    //      } else {
    //          document.body.classList.remove('dark-mode');
    //          localStorage.setItem('darkMode', 'false');
    //      }
    //  });

    //  // Logout functionality
    //  const logoutBtn = document.getElementById('logout-btn');
    //  const dropdownLogout = document.getElementById('dropdown-logout');

    //  function logout() {
    //      if (confirm('Are you sure you want to logout?')) {
    //          // In a real app, this would redirect to a login page
    //          // For demo purposes, we'll just show an alert
    //          alert('You have been logged out.');
    //      }
    //  }

    //  logoutBtn.addEventListener('click', function (e) {
    //      e.preventDefault();
    //      logout();
    //  });

    //  dropdownLogout.addEventListener('click', function (e) {
    //      e.preventDefault();
    //      logout();
    //  });
 });


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
