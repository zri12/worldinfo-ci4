<?php

namespace App\Controllers;

use App\Models\ManagedCountryModel;

class ManagedCountryController extends BaseController
{
    protected ManagedCountryModel $countryModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
        $this->countryModel = new ManagedCountryModel();
    }

    public function index(): string
    {
        $this->requireLogin();
        $query = trim((string) $this->request->getGet('q'));
        $builder = $this->countryModel->orderBy('created_at', 'DESC');
        if ($query !== '') {
            $builder->groupStart()
                ->like('name', $query)
                ->orLike('official_name', $query)
                ->orLike('code', $query)
                ->groupEnd();
        }

        return $this->adminView('managed_countries/index', [
            'countries' => $builder->findAll(),
            'query'     => $query,
        ], 'Kelola Negara');
    }

    public function create(): string
    {
        $this->requireLogin();
        return $this->adminView('managed_countries/form', [
            'country' => null,
            'action'  => base_url('admin/managed-countries/store'),
        ], 'Tambah Negara');
    }

    public function store()
    {
        $this->requireLogin();
        $data = $this->requestData();

        if (! $this->countryModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->countryModel->errors()));
        }

        return redirect()->to('/admin/managed-countries')->with('success', 'Negara berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $this->requireLogin();
        $country = $this->countryModel->find($id);
        if (! $country) {
            return redirect()->to('/admin/managed-countries')->with('error', 'Negara tidak ditemukan.');
        }

        return $this->adminView('managed_countries/form', [
            'country' => $country,
            'action'  => base_url('admin/managed-countries/update/' . $id),
        ], 'Edit Negara');
    }

    public function update(int $id)
    {
        $this->requireLogin();
        if (! $this->countryModel->find($id)) {
            return redirect()->to('/admin/managed-countries')->with('error', 'Negara tidak ditemukan.');
        }

        if (! $this->countryModel->update($id, $this->requestData())) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->countryModel->errors()));
        }

        return redirect()->to('/admin/managed-countries')->with('success', 'Data negara berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $this->requireLogin();
        $country = $this->countryModel->find($id);
        if (! $country) {
            return redirect()->to('/admin/managed-countries')->with('error', 'Negara tidak ditemukan.');
        }

        $this->countryModel->delete($id);
        return redirect()->to('/admin/managed-countries')->with('success', 'Negara ' . esc($country['name']) . ' berhasil dihapus.');
    }

    private function requestData(): array
    {
        return [
            'name'          => trim((string) $this->request->getPost('name')),
            'official_name' => trim((string) $this->request->getPost('official_name')),
            'code'          => strtoupper(trim((string) $this->request->getPost('code'))),
            'flag_url'      => trim((string) $this->request->getPost('flag_url')),
            'capital'       => trim((string) $this->request->getPost('capital')),
            'region'        => trim((string) $this->request->getPost('region')),
            'subregion'     => trim((string) $this->request->getPost('subregion')),
            'population'    => $this->request->getPost('population') ?: 0,
            'languages'     => trim((string) $this->request->getPost('languages')),
            'currencies'    => trim((string) $this->request->getPost('currencies')),
            'timezones'     => trim((string) $this->request->getPost('timezones')),
            'maps_url'      => trim((string) $this->request->getPost('maps_url')),
            'description'   => trim((string) $this->request->getPost('description')),
            'is_published'  => $this->request->getPost('is_published') === '1' ? 1 : 0,
        ];
    }

    private function adminView(string $view, array $data, string $title): string
    {
        $data['title'] = $title;
        $data['active_menu'] = 'managed_countries';

        return view('layouts/admin_layout', [
            'content'     => view($view, $data),
            'title'       => $title . ' - WorldInfo',
            'active_menu' => 'managed_countries',
        ]);
    }

    private function requireLogin(): void
    {
        if (! session()->get('is_logged_in')) {
            redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.')->send();
            exit;
        }
    }
}
