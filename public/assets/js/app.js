/**
 * WorldInfo – app.js
 * JavaScript utama untuk fungsi umum dan interaksi global.
 */

'use strict';

// ============================================================
// 1. SIDEBAR TOGGLE
// ============================================================

const sidebarToggle = document.getElementById('sidebarToggle');
const sidebar       = document.getElementById('sidebar');
const wrapper       = document.getElementById('app-wrapper');

let backdrop = null;

function createBackdrop() {
    backdrop = document.createElement('div');
    backdrop.classList.add('sidebar-backdrop');
    document.body.appendChild(backdrop);
    backdrop.addEventListener('click', closeSidebar);
}

function removeBackdrop() {
    if (backdrop) {
        backdrop.remove();
        backdrop = null;
    }
}

function openSidebar() {
    sidebar?.classList.add('sidebar-open');
    createBackdrop();
}

function closeSidebar() {
    sidebar?.classList.remove('sidebar-open');
    removeBackdrop();
}

function toggleSidebar() {
    if (window.innerWidth >= 992) {
        wrapper?.classList.toggle('sidebar-collapsed');
        const isCollapsed = wrapper?.classList.contains('sidebar-collapsed');
        localStorage.setItem('sidebarCollapsed', isCollapsed ? '1' : '0');
        updateSidebarToggleState(isCollapsed);
    } else {
        if (sidebar?.classList.contains('sidebar-open')) {
            closeSidebar();
        } else {
            openSidebar();
        }
        updateSidebarToggleState(false);
    }
}

function updateSidebarToggleState(isCollapsed) {
    if (!sidebarToggle) return;

    sidebarToggle.setAttribute('aria-expanded', isCollapsed ? 'false' : 'true');
    sidebarToggle.setAttribute('aria-label', isCollapsed ? 'Buka sidebar' : 'Tutup sidebar');
    sidebarToggle.setAttribute('title', isCollapsed ? 'Buka sidebar' : 'Tutup sidebar');

    const icon = sidebarToggle.querySelector('i');
    if (icon) {
        icon.className = isCollapsed ? 'bi bi-layout-sidebar-inset' : 'bi bi-list';
    }
}

if (sidebarToggle) {
    sidebarToggle.addEventListener('click', toggleSidebar);
}

// Restore sidebar state on desktop
if (window.innerWidth >= 992) {
    const collapsed = localStorage.getItem('sidebarCollapsed');
    if (collapsed === '1') {
        wrapper?.classList.add('sidebar-collapsed');
        updateSidebarToggleState(true);
    } else {
        updateSidebarToggleState(false);
    }
}

// Close sidebar on resize to desktop
window.addEventListener('resize', () => {
    if (window.innerWidth >= 992) {
        closeSidebar();
        updateSidebarToggleState(wrapper?.classList.contains('sidebar-collapsed'));
    } else {
        wrapper?.classList.remove('sidebar-collapsed');
        updateSidebarToggleState(false);
    }
});

// ============================================================
// 2. AUTO-DISMISS ALERTS
// ============================================================

document.querySelectorAll('.alert.alert-success, .alert.alert-info').forEach(function(alert) {
    setTimeout(function() {
        const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
        bsAlert.close();
    }, 4000);
});

// ============================================================
// 3. COUNTRY SEARCH & FILTER (Real-time di halaman negara)
// ============================================================

const countrySearchInput  = document.getElementById('countrySearch');
const regionFilterSelect  = document.getElementById('regionFilter');
const countryGrid         = document.getElementById('countryGrid');

function filterCountries() {
    const searchVal  = (countrySearchInput?.value || '').toLowerCase().trim();
    const regionVal  = (regionFilterSelect?.value || '').toLowerCase().trim();
    const cards      = countryGrid?.querySelectorAll('[data-country-name]') || [];
    let visibleCount = 0;

    cards.forEach(function(card) {
        const name   = (card.dataset.countryName || '').toLowerCase();
        const region = (card.dataset.region || '').toLowerCase();

        const matchSearch = !searchVal || name.includes(searchVal);
        const matchRegion = !regionVal || region === regionVal;

        if (matchSearch && matchRegion) {
            card.style.display = '';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    // Empty state saat tidak ada hasil
    const emptyState = document.getElementById('countryEmptyState');
    if (emptyState) {
        emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
    }
}

if (countrySearchInput) {
    countrySearchInput.addEventListener('input', filterCountries);
}
if (regionFilterSelect) {
    regionFilterSelect.addEventListener('change', filterCountries);
}

// ============================================================
// 4. FAVORIT SEARCH (Client-side)
// ============================================================

const favSearchInput = document.getElementById('favSearch');
const favTableBody   = document.getElementById('favTableBody');

if (favSearchInput) {
    favSearchInput.addEventListener('input', function() {
        const val  = this.value.toLowerCase().trim();
        const rows = favTableBody?.querySelectorAll('tr[data-name]') || [];
        rows.forEach(function(row) {
            const name = (row.dataset.name || '').toLowerCase();
            row.style.display = (!val || name.includes(val)) ? '' : 'none';
        });
    });
}

// ============================================================
// 5. KONFIRMASI HAPUS FAVORIT
// ============================================================

function confirmDelete(url, name) {
    const modal = document.getElementById('deleteConfirmModal');
    if (modal) {
        document.getElementById('deleteCountryName').textContent = name;
        document.getElementById('deleteConfirmBtn').href = url;
        new bootstrap.Modal(modal).show();
    } else {
        // Fallback jika modal tidak ada
        if (confirm('Apakah Anda yakin ingin menghapus "' + name + '" dari favorit?')) {
            window.location.href = url;
        }
    }
}

// ============================================================
// 6. TAMBAH FAVORIT DARI CARD NEGARA
// ============================================================

function openAddFavoriteModal(data) {
    const modal = document.getElementById('addFavoriteModal');
    if (!modal) return;

    // Isi hidden fields
    const fields = ['nama_negara', 'official_name', 'flag', 'region',
                    'subregion', 'capital', 'population', 'languages',
                    'currencies', 'timezones', 'maps_url'];

    fields.forEach(function(field) {
        const el = document.getElementById('fav_' + field);
        if (el) el.value = data[field] || '';
    });

    // Tampilkan nama negara di modal title
    const titleEl = document.getElementById('addFavoriteModalLabel');
    if (titleEl) titleEl.textContent = 'Tambah "' + (data.nama_negara || '') + '" ke Favorit';

    // Default tanggal
    const tglEl = document.getElementById('fav_tanggal');
    if (tglEl) tglEl.value = new Date().toISOString().split('T')[0];

    new bootstrap.Modal(modal).show();
}

// ============================================================
// 7. TOOLTIPS
// ============================================================

const tooltipEls = document.querySelectorAll('[data-bs-toggle="tooltip"]');
tooltipEls.forEach(function(el) {
    new bootstrap.Tooltip(el);
});

// ============================================================
// 8. FORMAT ANGKA POPULASI
// ============================================================

function formatPopulation(num) {
    if (!num) return '-';
    return new Intl.NumberFormat('id-ID').format(num);
}

// Apply format ke semua elemen dengan class format-population
document.querySelectorAll('.format-population').forEach(function(el) {
    const raw = parseInt(el.textContent.replace(/[^0-9]/g, ''), 10);
    if (!isNaN(raw)) el.textContent = formatPopulation(raw);
});
