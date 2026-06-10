/**
 * WorldInfo – favorites.js
 * JavaScript khusus untuk halaman Favorit Negara.
 */

'use strict';

// ============================================================
// 1. SEARCH FAVORIT (Real-time)
// ============================================================

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('favSearch');
    const statusFilter = document.getElementById('statusFilter');
    const tableBody    = document.getElementById('favTableBody');
    const emptyState   = document.getElementById('favEmptyState');

    function filterFavorites() {
        const searchVal = (searchInput?.value || '').toLowerCase().trim();
        const statusVal = (statusFilter?.value || '').toLowerCase().trim();

        if (!tableBody) return;

        const rows = tableBody.querySelectorAll('tr[data-name]');
        let visible = 0;

        rows.forEach(function(row) {
            const name   = (row.dataset.name || '').toLowerCase();
            const status = (row.dataset.status || '').toLowerCase();

            const matchSearch = !searchVal || name.includes(searchVal);
            const matchStatus = !statusVal || status === statusVal;

            if (matchSearch && matchStatus) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        if (emptyState) {
            emptyState.style.display = visible === 0 ? 'block' : 'none';
        }
    }

    if (searchInput) searchInput.addEventListener('input', filterFavorites);
    if (statusFilter) statusFilter.addEventListener('change', filterFavorites);

    // ============================================================
    // 2. KONFIRMASI HAPUS FAVORIT
    // ============================================================

    const deleteModal     = document.getElementById('deleteConfirmModal');
    const deleteNameEl    = document.getElementById('deleteCountryName');
    const deleteConfirmBtn = document.getElementById('deleteConfirmBtn');

    document.querySelectorAll('[data-delete-url]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const url  = this.dataset.deleteUrl;
            const name = this.dataset.countryName;

            if (deleteModal) {
                if (deleteNameEl) deleteNameEl.textContent = name;
                if (deleteConfirmBtn) deleteConfirmBtn.href = url;
                new bootstrap.Modal(deleteModal).show();
            } else {
                if (confirm('Hapus "' + name + '" dari favorit?')) {
                    window.location.href = url;
                }
            }
        });
    });

    // ============================================================
    // 3. MODAL TAMBAH FAVORIT (dari card negara)
    // ============================================================

    const addModal = document.getElementById('addFavoriteModal');
    const addForm  = document.getElementById('addFavoriteForm');

    document.querySelectorAll('[data-add-favorite]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const data = JSON.parse(this.dataset.addFavorite || '{}');

            if (!addModal) return;

            // Isi semua hidden fields
            const fields = ['nama_negara', 'official_name', 'flag', 'region',
                            'subregion', 'capital', 'population', 'languages',
                            'currencies', 'timezones', 'maps_url'];

            fields.forEach(function(field) {
                const el = addForm?.querySelector('[name="' + field + '"]');
                if (el) el.value = data[field] || '';
            });

            // Update modal title
            const titleEl = document.getElementById('addFavoriteModalLabel');
            if (titleEl) titleEl.textContent = 'Tambah "' + (data.nama_negara || '') + '" ke Favorit';

            // Set tanggal default hari ini
            const tglEl = addForm?.querySelector('[name="tanggal_ditambahkan"]');
            if (tglEl) tglEl.value = new Date().toISOString().split('T')[0];

            new bootstrap.Modal(addModal).show();
        });
    });

    // ============================================================
    // 4. RESET SEARCH
    // ============================================================

    const resetBtn = document.getElementById('resetSearch');
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            if (searchInput) searchInput.value = '';
            if (statusFilter) statusFilter.value = '';
            filterFavorites();
        });
    }
});
