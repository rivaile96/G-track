import './bootstrap';

// resources/js/app.js

document.addEventListener('DOMContentLoaded', function() {
    
    // Logika untuk Tombol Lipat Sidebar
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const layout = document.querySelector('.dashboard-layout');

    if (sidebarToggle && layout) {
        sidebarToggle.addEventListener('click', function() {
            layout.classList.toggle('sidebar-collapsed');
        });
    }

    // Logika untuk Dropdown Menu
    const submenuItems = document.querySelectorAll('.has-submenu > .nav-link');

    submenuItems.forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah link pindah halaman
            const parent = this.parentElement;
            const submenu = parent.querySelector('.submenu');

            parent.classList.toggle('open');
            submenu.classList.toggle('open');
        });
    });

});