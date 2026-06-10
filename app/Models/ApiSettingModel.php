<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ApiSettingModel
 *
 * Model untuk mengelola konfigurasi API di tabel api_settings.
 */
class ApiSettingModel extends Model
{
    protected $table            = 'api_settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'nama_api',
        'base_url',
        'method',
        'api_key',
        'auth_header',
        'status',
        'last_sync',
    ];

    // Timestamps
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation Rules
    protected $validationRules = [
        'nama_api' => 'required|max_length[100]',
        'base_url' => 'required',
        'method'   => 'required|in_list[GET,POST,PUT,DELETE]',
        'status'   => 'required|in_list[Aktif,Tidak Aktif]',
    ];

    protected $validationMessages = [
        'nama_api' => [
            'required'   => 'Nama API wajib diisi.',
            'max_length' => 'Nama API maksimal 100 karakter.',
        ],
        'base_url' => [
            'required' => 'URL endpoint API wajib diisi.',
        ],
        'method' => [
            'required' => 'Method HTTP wajib dipilih.',
            'in_list'  => 'Method tidak valid (GET/POST/PUT/DELETE).',
        ],
        'status' => [
            'required' => 'Status API wajib dipilih.',
            'in_list'  => 'Status tidak valid (Aktif/Tidak Aktif).',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // ============================================================
    // Custom Methods
    // ============================================================

    /**
     * Ambil API yang sedang aktif (status = 'Aktif')
     */
    public function getActiveApi(): ?array
    {
        return $this->where('status', 'Aktif')->first();
    }

    /**
     * Update waktu last_sync berdasarkan ID
     */
    public function updateLastSync(int $id): bool
    {
        return $this->update($id, [
            'last_sync' => date('Y-m-d H:i:s'),
        ]);
    }

    public function deactivateOthers(?int $exceptId = null): bool
    {
        $builder = $this->builder();

        if ($exceptId !== null) {
            $builder->where('id !=', $exceptId);
        }

        return $builder->update([
            'status'     => 'Tidak Aktif',
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Hitung total API yang terdaftar
     */
    public function countAll(): int
    {
        return $this->countAllResults();
    }
}
