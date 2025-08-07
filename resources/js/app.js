// import './bootstrap'; // <-- Dinonaktifkan sementara untuk tes konflik

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
    const submenuTriggers = document.querySelectorAll('.has-submenu > .nav-link');

    submenuTriggers.forEach(trigger => {
        trigger.addEventListener('click', function(event) {
            event.preventDefault();

            const parentNavItem = this.parentElement;
            const submenu = parentNavItem.querySelector('.submenu');

            parentNavItem.classList.toggle('open');

            if (submenu) {
                submenu.classList.toggle('open');
            }
        });
    });

});