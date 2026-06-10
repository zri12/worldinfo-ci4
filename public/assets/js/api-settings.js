/**
 * WorldInfo – api-settings.js
 * JavaScript khusus untuk halaman Pengaturan API.
 * Mengelola Test API (AJAX) dan Sync Data.
 */

'use strict';

// ============================================================
// 1. TEST API
// ============================================================

/**
 * Uji koneksi ke endpoint API via AJAX
 * @param {string} url - URL endpoint yang akan ditest
 * @param {number} settingId - ID api_setting (opsional)
 */
function testApiConnection(url, settingId) {
    if (!url) {
        showApiResult('error', 'URL endpoint tidak boleh kosong.', null);
        return;
    }

    const btn = document.querySelector('[data-test-id="' + settingId + '"]');
    const originalHtml = btn ? btn.innerHTML : '';

    // Loading state pada tombol
    if (btn) {
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Testing...';
    }

    const requestBody = {
        url: url,
        id: settingId === 'new' ? '' : (settingId || ''),
    };
    if (settingId === 'new' || settingId === 'form') {
        requestBody.api_key = document.getElementById('newApiKey')?.value || '';
        requestBody.auth_header = document.getElementById('newAuthHeader')?.value || '';
    }

    fetch(BASE_URL + '/api-settings/test', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: new URLSearchParams(requestBody),
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        if (data.success) {
            showApiResult('success', data.message, data.preview, settingId);
            updateStatusBadge(settingId, 'connected');
        } else {
            showApiResult('error', data.message, null, settingId);
            updateStatusBadge(settingId, 'error');
        }
    })
    .catch(function(err) {
        showApiResult('error', 'Gagal menghubungi server: ' + err.message, null, settingId);
    })
    .finally(function() {
        if (btn) {
            btn.disabled = false;
            btn.innerHTML = originalHtml;
        }
    });
}

/**
 * Tampilkan hasil test API di area result
 */
function showApiResult(type, message, preview, settingId) {
    const resultEl = settingId
        ? document.getElementById('apiResult_' + settingId)
        : document.getElementById('apiResult');

    if (!resultEl) {
        // Tampilkan sebagai alert di atas halaman
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const iconClass  = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
        const alertHtml  = `
            <div class="alert ${alertClass} alert-dismissible fade show d-flex align-items-start gap-2" role="alert">
                <i class="bi ${iconClass} flex-shrink-0 mt-1"></i>
                <div>
                    <strong>${message}</strong>
                    ${preview ? '<br><small class="text-muted">' + preview + '</small>' : ''}
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>`;

        const container = document.getElementById('alertContainer') || document.querySelector('.page-content');
        if (container) {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = alertHtml;
            container.insertBefore(tempDiv.firstElementChild, container.firstChild);
        }
        return;
    }

    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const iconClass  = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';

    resultEl.innerHTML = `
        <div class="alert ${alertClass} d-flex align-items-start gap-2 mb-0 mt-2">
            <i class="bi ${iconClass} flex-shrink-0"></i>
            <div>
                <strong>${message}</strong>
                ${preview ? '<br><small>' + preview + '</small>' : ''}
            </div>
        </div>`;
    resultEl.style.display = 'block';
}

/**
 * Update badge status API di tabel
 */
function updateStatusBadge(settingId, status) {
    const badgeEl = document.getElementById('statusBadge_' + settingId);
    if (!badgeEl) return;

    if (status === 'connected') {
        badgeEl.className = 'badge status-connected';
        badgeEl.textContent = 'Connected';
    } else {
        badgeEl.className = 'badge status-error';
        badgeEl.textContent = 'Error';
    }
}

// ============================================================
// 2. EDIT API MODAL
// ============================================================

/**
 * Isi form edit modal dengan data dari row tabel
 */
function openEditModal(id, namaApi, baseUrl, method, apiKey, status) {
    document.getElementById('edit_id').value       = id;
    document.getElementById('edit_nama_api').value = namaApi;
    document.getElementById('edit_base_url').value = baseUrl;
    document.getElementById('edit_method').value   = method;
    document.getElementById('edit_api_key').value  = apiKey || '';
    document.getElementById('edit_status').value   = status;

    // Update form action
    const form = document.getElementById('editApiForm');
    if (form) {
        form.action = BASE_URL + '/api-settings/update/' + id;
    }

    const modal = document.getElementById('editApiModal');
    if (modal) new bootstrap.Modal(modal).show();
}

// ============================================================
// 3. DELETE KONFIRMASI
// ============================================================

function confirmDeleteApi(id, namaApi) {
    const modal = document.getElementById('deleteApiModal');
    if (modal) {
        document.getElementById('deleteApiName').textContent = namaApi;
        document.getElementById('deleteApiBtn').href = BASE_URL + '/api-settings/delete/' + id;
        new bootstrap.Modal(modal).show();
    } else {
        if (confirm('Hapus API "' + namaApi + '"?')) {
            window.location.href = BASE_URL + '/api-settings/delete/' + id;
        }
    }
}

// ============================================================
// 4. SYNC DATA
// ============================================================

function syncApiData(id) {
    const btn = document.querySelector('[data-sync-id="' + id + '"]');
    const originalHtml = btn ? btn.innerHTML : '';

    if (btn) {
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Syncing...';
    }

    // Submit form sync via POST
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = BASE_URL + '/api-settings/sync';
    form.style.display = 'none';

    const input = document.createElement('input');
    input.type  = 'hidden';
    input.name  = 'id';
    input.value = id;
    form.appendChild(input);

    document.body.appendChild(form);
    form.submit();
}
