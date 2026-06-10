<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * FavoriteCountryModel
 *
 * Model untuk mengelola data negara favorit/wishlist di tabel favorite_countries.
 */
class FavoriteCountryModel extends Model
{
    protected $table            = 'favorite_countries';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'nama_negara',
        'official_name',
        'flag',
        'region',
        'subregion',
        'capital',
        'population',
        'languages',
        'currencies',
        'timezones',
        'maps_url',
        'status_wishlist',
        'catatan',
        'tanggal_ditambahkan',
    ];

    // Timestamps – CI4 otomatis mengisi created_at dan updated_at
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation Rules
    protected $validationRules = [
        'nama_negara'     => 'required|max_length[100]',
        'status_wishlist' => 'required|in_list[Wishlist,Want to Go,Visited,Planning]',
    ];

    protected $validationMessages = [
        'nama_negara' => [
            'required'   => 'Nama negara wajib diisi.',
            'max_length' => 'Nama negara maksimal 100 karakter.',
        ],
        'status_wishlist' => [
            'required' => 'Status wishlist wajib dipilih.',
            'in_list'  => 'Status wishlist tidak valid.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // ============================================================
    // Custom Methods
    // ============================================================

    /**
     * Cari favorit berdasarkan nama negara
     */
    public function searchByName(string $keyword): array
    {
        return $this->like('nama_negara', $keyword)->findAll();
    }

    /**
     * Filter berdasarkan status wishlist
     */
    public function filterByStatus(string $status): array
    {
        return $this->where('status_wishlist', $status)->findAll();
    }

    /**
     * Cek apakah negara sudah ada di favorit berdasarkan nama
     */
    public function isAlreadyFavorite(string $namaNegara): bool
    {
        return $this->where('nama_negara', $namaNegara)->countAllResults() > 0;
    }

    /**
     * Hitung total favorit
     */
    public function countFavorites(): int
    {
        return $this->countAllResults();
    }

    /**
     * Ambil favorit terbaru dengan limit
     */
    public function getRecent(int $limit = 5): array
    {
        return $this->orderBy('created_at', 'DESC')->findAll($limit);
    }
}
