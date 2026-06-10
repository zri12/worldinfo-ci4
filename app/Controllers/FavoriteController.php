<?php

namespace App\Controllers;

use App\Models\FavoriteCountryModel;

/**
 * FavoriteController
 *
 * Mengelola CRUD data negara favorit/wishlist.
 */
class FavoriteController extends BaseController
{
    protected FavoriteCountryModel $favoriteModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
        $this->favoriteModel = new FavoriteCountryModel();
    }

    /**
     * Proteksi halaman: cek login
     */
    private function checkLogin(): bool
    {
        if (! session()->get('is_logged_in')) {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu.');
            redirect()->to('/login')->send();
            return false;
        }
        return true;
    }

    /**
     * READ – Daftar semua favorit
     */
    public function index(): string
    {
        if (! $this->checkLogin()) exit;

        $search = $this->request->getGet('search');
        $status = $this->request->getGet('status');

        $builder = $this->favoriteModel;

        if ($search) {
            $favorites = $this->favoriteModel->searchByName($search);
        } elseif ($status) {
            $favorites = $this->favoriteModel->filterByStatus($status);
        } else {
            $favorites = $this->favoriteModel->orderBy('created_at', 'DESC')->findAll();
        }

        $data = [
            'title'       => 'Favorit Negara',
            'active_menu' => 'favorites',
            'favorites'   => $favorites,
            'search'      => $search,
            'status_filter' => $status,
        ];

        return view('layouts/admin_layout', [
            'content'     => view('favorites/index', $data),
            'title'       => 'Favorit Negara – WorldInfo',
            'active_menu' => 'favorites',
        ]);
    }

    /**
     * CREATE – Tampilkan form tambah favorit
     */
    public function create(): string
    {
        if (! $this->checkLogin()) exit;

        $data = [
            'title'       => 'Tambah Favorit',
            'active_menu' => 'favorites',
            'validation'  => \Config\Services::validation(),
        ];

        return view('layouts/admin_layout', [
            'content'     => view('favorites/create', $data),
            'title'       => 'Tambah Favorit – WorldInfo',
            'active_menu' => 'favorites',
        ]);
    }

    /**
     * STORE – Simpan data favorit baru
     */
    public function store()
    {
        if (! $this->checkLogin()) exit;

        $rules = [
            'nama_negara'     => 'required|max_length[100]',
            'status_wishlist' => 'required',
        ];

        if (! $this->validate($rules)) {
            session()->setFlashdata('error', 'Validasi gagal. Periksa kembali isian form.');
            return redirect()->back()->withInput();
        }

        $data = [
            'nama_negara'         => $this->request->getPost('nama_negara'),
            'official_name'       => $this->request->getPost('official_name'),
            'flag'                => $this->request->getPost('flag'),
            'region'              => $this->request->getPost('region'),
            'subregion'           => $this->request->getPost('subregion'),
            'capital'             => $this->request->getPost('capital'),
            'population'          => $this->request->getPost('population') ?: null,
            'languages'           => $this->request->getPost('languages'),
            'currencies'          => $this->request->getPost('currencies'),
            'timezones'           => $this->request->getPost('timezones'),
            'maps_url'            => $this->request->getPost('maps_url'),
            'status_wishlist'     => $this->request->getPost('status_wishlist'),
            'catatan'             => $this->request->getPost('catatan'),
            'tanggal_ditambahkan' => $this->request->getPost('tanggal_ditambahkan') ?: date('Y-m-d'),
        ];

        if ($this->favoriteModel->insert($data)) {
            session()->setFlashdata('success', 'Negara <strong>' . esc($data['nama_negara']) . '</strong> berhasil ditambahkan ke favorit!');
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan data favorit. Silakan coba lagi.');
        }

        return redirect()->to('/favorites');
    }

    /**
     * EDIT – Tampilkan form edit favorit
     */
    public function edit(int $id): string
    {
        if (! $this->checkLogin()) exit;

        $favorite = $this->favoriteModel->find($id);

        if (! $favorite) {
            session()->setFlashdata('error', 'Data favorit tidak ditemukan.');
            return redirect()->to('/favorites');
        }

        $data = [
            'title'       => 'Edit Favorit',
            'active_menu' => 'favorites',
            'favorite'    => $favorite,
            'validation'  => \Config\Services::validation(),
        ];

        return view('layouts/admin_layout', [
            'content'     => view('favorites/edit', $data),
            'title'       => 'Edit Favorit – WorldInfo',
            'active_menu' => 'favorites',
        ]);
    }

    /**
     * UPDATE – Perbarui data favorit
     */
    public function update(int $id)
    {
        if (! $this->checkLogin()) exit;

        $favorite = $this->favoriteModel->find($id);
        if (! $favorite) {
            session()->setFlashdata('error', 'Data favorit tidak ditemukan.');
            return redirect()->to('/favorites');
        }

        $rules = [
            'status_wishlist' => 'required',
        ];

        if (! $this->validate($rules)) {
            session()->setFlashdata('error', 'Validasi gagal. Periksa kembali isian form.');
            return redirect()->back()->withInput();
        }

        $data = [
            'status_wishlist'     => $this->request->getPost('status_wishlist'),
            'catatan'             => $this->request->getPost('catatan'),
            'tanggal_ditambahkan' => $this->request->getPost('tanggal_ditambahkan') ?: $favorite['tanggal_ditambahkan'],
        ];

        if ($this->favoriteModel->update($id, $data)) {
            session()->setFlashdata('success', 'Data favorit <strong>' . esc($favorite['nama_negara']) . '</strong> berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data. Silakan coba lagi.');
        }

        return redirect()->to('/favorites');
    }

    /**
     * DELETE – Hapus data favorit
     */
    public function delete(int $id)
    {
        if (! $this->checkLogin()) exit;

        $favorite = $this->favoriteModel->find($id);
        if (! $favorite) {
            session()->setFlashdata('error', 'Data favorit tidak ditemukan.');
            return redirect()->to('/favorites');
        }

        if ($this->favoriteModel->delete($id)) {
            session()->setFlashdata('success', 'Negara <strong>' . esc($favorite['nama_negara']) . '</strong> berhasil dihapus dari favorit.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data. Silakan coba lagi.');
        }

        return redirect()->to('/favorites');
    }
}
