<?php

namespace App\Controllers;

use App\Libraries\CountryApiService;
use App\Models\ApiSettingModel;
use App\Models\FavoriteCountryModel;
use App\Models\ManagedCountryModel;

class CountryController extends BaseController
{
    protected ApiSettingModel $apiSettingModel;
    protected FavoriteCountryModel $favoriteModel;
    protected ManagedCountryModel $managedCountryModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
        $this->apiSettingModel = new ApiSettingModel();
        $this->favoriteModel = new FavoriteCountryModel();
        $this->managedCountryModel = new ManagedCountryModel();
    }

    public function landing(): string
    {
        return view('layouts/public_layout', [
            'content' => view('landing/index', ['title' => 'WorldInfo']),
            'title'   => 'WorldInfo - Jelajahi Dunia Tanpa Batas',
        ]);
    }

    public function index(): string
    {
        return $this->renderIndex(false);
    }

    public function adminIndex()
    {
        if (! session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $this->renderIndex(true);
    }

    private function renderIndex(bool $isAdmin): string
    {
        $allCountries = [];
        $error = null;
        $query = trim((string) $this->request->getGet('q'));
        $selectedRegion = trim((string) $this->request->getGet('region'));
        $currentPage = max(1, (int) $this->request->getGet('page'));
        $perPage = 24;
        $apiSetting = $this->apiSettingModel->getActiveApi();

        if (! $apiSetting) {
            $error = 'Belum ada API yang dikonfigurasi.';
        } else {
            try {
                $allCountries = (new CountryApiService())->getAll(
                    $apiSetting['base_url'],
                    $this->request->getGet('refresh') === '1'
                );
            } catch (\Throwable $e) {
                $error = 'Koneksi ke API gagal: ' . $e->getMessage();
                log_message('error', 'CountryController::index - ' . $e->getMessage());
            }
        }

        $managedCountries = array_map(
            fn (array $country): array => $this->managedCountryModel->toApiShape($country),
            $this->managedCountryModel->published()
        );
        $existingNames = array_map(
            static fn (array $country): string => strtolower($country['name']['common'] ?? ''),
            $allCountries
        );
        foreach ($managedCountries as $country) {
            if (! in_array(strtolower($country['name']['common']), $existingNames, true)) {
                $allCountries[] = $country;
            }
        }
        usort($allCountries, static fn (array $a, array $b): int =>
            strcasecmp($a['name']['common'] ?? '', $b['name']['common'] ?? '')
        );

        $regions = [];
        foreach ($allCountries as $country) {
            $countryRegion = $country['region'] ?? '';
            if ($countryRegion !== '' && ! in_array($countryRegion, $regions, true)) {
                $regions[] = $countryRegion;
            }
        }
        sort($regions);

        $filteredCountries = array_values(array_filter(
            $allCountries,
            static function (array $country) use ($query, $selectedRegion): bool {
                $matchesQuery = $query === ''
                    || stripos($country['name']['common'] ?? '', $query) !== false;
                $matchesRegion = $selectedRegion === ''
                    || ($country['region'] ?? '') === $selectedRegion;

                return $matchesQuery && $matchesRegion;
            }
        ));

        $totalFiltered = count($filteredCountries);
        $totalPages = max(1, (int) ceil($totalFiltered / $perPage));
        $currentPage = min($currentPage, $totalPages);
        $countries = array_slice($filteredCountries, ($currentPage - 1) * $perPage, $perPage);

        $data = [
            'title'             => 'Daftar Negara',
            'active_menu'       => 'countries',
            'countries'         => $countries,
            'regions'           => $regions,
            'error'             => $error,
            'query'             => $query,
            'selected_region'   => $selectedRegion,
            'total_countries'   => count($allCountries),
            'total_filtered'    => $totalFiltered,
            'current_page'      => $currentPage,
            'total_pages'       => $totalPages,
        ];

        return view($isAdmin ? 'layouts/admin_layout' : 'layouts/public_layout', [
            'content'     => view($isAdmin ? 'countries/index' : 'countries/public_index', $data),
            'title'       => 'Daftar Negara - WorldInfo',
            'active_menu' => 'countries',
        ]);
    }

    public function detail(string $name): string
    {
        $country = null;
        $error = null;
        $managedCountry = $this->managedCountryModel->findByName(urldecode($name));
        if ($managedCountry && (int) $managedCountry['is_published'] === 1) {
            $country = $this->managedCountryModel->toApiShape($managedCountry);
        }

        $apiSetting = $this->apiSettingModel->getActiveApi();
        $baseUrl = $apiSetting
            ? preg_replace('~/all(?:\?.*)?$~', '', rtrim($apiSetting['base_url'], '/'))
            : 'https://restcountries.com/v3.1';
        $detailUrl = rtrim($baseUrl, '/') . '/name/' . urlencode($name);

        if (! $country) {
            try {
                $country = (new CountryApiService())->getDetail($detailUrl);
                if (! $country) {
                    $error = 'Negara tidak ditemukan.';
                }
            } catch (\Throwable $e) {
                $error = 'Koneksi ke API gagal: ' . $e->getMessage();
                log_message('error', 'CountryController::detail - ' . $e->getMessage());
            }
        }

        $data = [
            'title'       => $country['name']['common'] ?? 'Detail Negara',
            'active_menu' => 'countries',
            'country'     => $country,
            'error'       => $error,
        ];

        return view('layouts/public_layout', [
            'content'     => view('countries/detail', $data),
            'title'       => ($country['name']['common'] ?? 'Detail Negara') . ' - WorldInfo',
        ]);
    }
}
