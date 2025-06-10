// File: resources/js/pomodoro/spline-pomo.js

// Fungsi ini akan diekspor dan dipanggil oleh pomotime.js
export function initPomoSpline() {
    const splineFocusContainer = document.getElementById('spline-focus');
    const splineBreakContainer = document.getElementById('spline-break');

    // Pastikan semua elemen ada sebelum melanjutkan
    if (!splineFocusContainer || !splineBreakContainer) return;

    // Fungsi untuk mengganti spline yang aktif
    function switchSpline(mode) {
        // Tentukan kontainer mana yang harus aktif dan mana yang harus disembunyikan
        const activeContainer = (mode === 'focus') ? splineFocusContainer : splineBreakContainer;
        const inactiveContainer = (mode === 'focus') ? splineBreakContainer : splineFocusContainer;

        // Hanya jalankan animasi jika statusnya memang berubah
        if (!activeContainer.classList.contains('active')) {
            // Sembunyikan yang tidak aktif
            inactiveContainer.classList.remove('active');
            inactiveContainer.classList.add('hidden');

            // Tampilkan yang aktif dengan animasi
            activeContainer.classList.remove('hidden');
            activeContainer.classList.add('active');

            // Memicu reflow agar animasi berjalan setiap kali
            activeContainer.style.animation = 'none';
            activeContainer.offsetHeight; // Memicu reflow
            activeContainer.style.animation = null;
            activeContainer.classList.add('slide-in');
        }
    }

    // Dengarkan event 'pomoModeChanged' yang akan dikirim oleh timer.js
    document.addEventListener('pomoModeChanged', (e) => {
        const newMode = e.detail.mode; // mode akan berisi 'focus' atau 'break'
        switchSpline(newMode);
    });

    // Inisialisasi awal, tampilkan spline fokus
    switchSpline('focus');
}