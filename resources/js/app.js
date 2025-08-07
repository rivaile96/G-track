// [DEBUGGING] Kita nonaktifkan sementara untuk melihat apakah ada konflik.
// import './bootstrap'; 

/**
 * Script ini akan berjalan setelah seluruh halaman HTML selesai dimuat.
 */
document.addEventListener('DOMContentLoaded', function() {
    
    // =======================================================
    // LOGIKA UNTUK MELIPAT SIDEBAR (AUTO HIDE)
    // =======================================================
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const layout = document.querySelector('.dashboard-layout');

    // Cek apakah elemennya ada di halaman
    if (sidebarToggle && layout) {
        // Tambahkan 'event listener' yang akan merespon saat tombol di-klik
        sidebarToggle.addEventListener('click', function() {
            // 'toggle' artinya: jika class-nya ada, hapus. Jika tidak ada, tambahkan.
            layout.classList.toggle('sidebar-collapsed');
        });
    }

    // =======================================================
    // LOGIKA UNTUK MENU DROPDOWN
    // =======================================================
    // Ambil semua link menu utama yang punya submenu
    const submenuTriggers = document.querySelectorAll('.has-submenu > .nav-link');

    // Lakukan perulangan untuk setiap link menu tersebut
    submenuTriggers.forEach(trigger => {
        // Tambahkan 'event listener' untuk merespon saat di-klik
        trigger.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah link pindah halaman saat diklik

            const parentNavItem = this.parentElement; // div .nav-item
            const submenu = parentNavItem.querySelector('.submenu'); // ul .submenu

            // Toggle class 'open' pada elemen induk dan submenu-nya
            parentNavItem.classList.toggle('open');

            if (submenu) {
                submenu.classList.toggle('open');
            }
        });
    });

    // =======================================================
    // LOGIKA UNTUK MODAL TAMBAH DRIVER
    // =======================================================
    const modal = document.getElementById('driver-modal');
    const openBtn = document.getElementById('add-driver-btn');
    const closeBtn = document.getElementById('close-modal-btn');
    const cancelBtn = document.getElementById('cancel-modal-btn');

    // Pastikan semua elemennya ada
    if (modal && openBtn && closeBtn && cancelBtn) {
        // Fungsi untuk membuka modal
        openBtn.addEventListener('click', () => {
            modal.classList.add('active');
        });

        // Fungsi untuk menutup modal
        const closeModal = () => {
            modal.classList.remove('active');
        };

        closeBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);

        // Tutup juga saat klik di luar area modal
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal();
            }
        });
    }

});
