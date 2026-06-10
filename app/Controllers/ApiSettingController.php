<?php

namespace App\Controllers;

use App\Models\ApiSettingModel;

class ApiSettingController extends BaseController
{
    protected ApiSettingModel $apiSettingModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
        $this->apiSettingModel = new ApiSettingModel();
    }

    public function index()
    {
        return redirect()->to('/api-settings/countries');
    }

    public function countries(): string
    {
        $this->requireLogin();
        $apiSettings = $this->apiSettingModel->orderBy('created_at', 'DESC')->findAll();

        return view('layouts/admin_layout', [
            'content' => view('api_settings/index', [
                'title'        => 'API Negara',
                'active_menu'  => 'api_countries',
                'api_settings' => $apiSettings,
            ]),
            'title'       => 'API Negara - WorldInfo',
            'active_menu' => 'api_countries',
        ]);
    }

    public function store()
    {
        $this->requireLogin();
        if (! $this->validate($this->rules())) {
            return redirect()->to('/api-settings/countries')->with('error', 'Validasi gagal. Periksa kembali isian form.');
        }

        $data = $this->requestData();
        if ($data['status'] === 'Aktif') {
            $this->apiSettingModel->deactivateOthers();
        }

        if ($this->apiSettingModel->insert($data)) {
            return redirect()->to('/api-settings/countries')->with('success', 'API negara berhasil disimpan.');
        }

        return redirect()->to('/api-settings/countries')->with('error', 'Gagal menyimpan API negara.');
    }

    public function testApi()
    {
        $this->requireLogin();
        $id = (int) $this->request->getPost('id');
        $setting = $id > 0 ? $this->apiSettingModel->find($id) : null;
        $url = (string) ($setting['base_url'] ?? $this->request->getPost('url'));
        $apiKey = $setting['api_key'] ?? $this->request->getPost('api_key');
        $authHeader = $setting['auth_header'] ?? $this->request->getPost('auth_header');

        try {
            $decoded = $this->requestJson($url, $apiKey, $authHeader);

            return $this->response->setJSON([
                'success'     => true,
                'message'     => 'Koneksi berhasil dan respons JSON dikenali.',
                'status_code' => 200,
                'preview'     => count($decoded) . ' item data diterima.',
            ]);
        } catch (\Throwable $exception) {
            return $this->response->setJSON([
                'success'     => false,
                'message'     => 'Koneksi gagal: ' . $exception->getMessage(),
                'status_code' => null,
                'preview'     => null,
            ]);
        }
    }

    public function sync()
    {
        $this->requireLogin();
        $setting = $this->apiSettingModel->find((int) $this->request->getPost('id'));
        if (! $setting) {
            return redirect()->to('/api-settings/countries')->with('error', 'API tidak ditemukan.');
        }

        try {
            $this->requestJson($setting['base_url'], $setting['api_key'] ?? null, $setting['auth_header'] ?? null);
            $this->apiSettingModel->updateLastSync((int) $setting['id']);

            return redirect()->to('/api-settings/countries')->with('success', 'Sinkronisasi data negara berhasil.');
        } catch (\Throwable $exception) {
            return redirect()->to('/api-settings/countries')->with('error', 'Sinkronisasi gagal: ' . $exception->getMessage());
        }
    }

    public function update(int $id)
    {
        $this->requireLogin();
        $setting = $this->apiSettingModel->find($id);
        if (! $setting) {
            return redirect()->to('/api-settings/countries')->with('error', 'API tidak ditemukan.');
        }

        $data = $this->requestData();
        if ($data['api_key'] === null && ! empty($setting['api_key'])) {
            $data['api_key'] = $setting['api_key'];
        }
        if ($data['status'] === 'Aktif') {
            $this->apiSettingModel->deactivateOthers($id);
        }

        $this->apiSettingModel->update($id, $data);
        return redirect()->to('/api-settings/countries')->with('success', 'API negara berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $this->requireLogin();
        $this->apiSettingModel->delete($id);

        return redirect()->to('/api-settings/countries')->with('success', 'API negara berhasil dihapus.');
    }

    private function requestJson(string $url, ?string $apiKey, ?string $authHeader): array
    {
        if ($url === '') {
            throw new \RuntimeException('URL endpoint tidak boleh kosong.');
        }

        $headers = ['Accept' => 'application/json'];
        if ($apiKey && $authHeader) {
            $headers[$authHeader] = $apiKey;
        }

        $response = \Config\Services::curlrequest()->request('GET', $url, [
            'connect_timeout' => 4,
            'timeout'         => 15,
            'verify'          => false,
            'headers'         => $headers,
            'http_errors'     => false,
        ]);
        $decoded = json_decode($response->getBody(), true);

        if ($response->getStatusCode() !== 200 || ! is_array($decoded)) {
            throw new \RuntimeException('Endpoint harus merespons JSON dengan status 200.');
        }

        return $decoded;
    }

    private function requestData(): array
    {
        return [
            'nama_api'    => trim((string) $this->request->getPost('nama_api')),
            'base_url'    => trim((string) $this->request->getPost('base_url')),
            'method'      => 'GET',
            'api_key'     => trim((string) $this->request->getPost('api_key')) ?: null,
            'auth_header' => trim((string) $this->request->getPost('auth_header')) ?: null,
            'status'      => $this->request->getPost('status') ?: 'Aktif',
        ];
    }

    private function rules(): array
    {
        return [
            'nama_api' => 'required|max_length[100]',
            'base_url' => 'required|valid_url_strict',
            'method'   => 'required|in_list[GET]',
        ];
    }

    private function requireLogin(): void
    {
        if (! session()->get('is_logged_in')) {
            redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.')->send();
            exit;
        }
    }
}
