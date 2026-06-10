<?php

namespace App\Controllers;

use App\Libraries\CountryApiService;
use App\Models\ApiSettingModel;
use App\Models\FavoriteCountryModel;

class DashboardController extends BaseController
{
    protected FavoriteCountryModel $favoriteModel;
    protected ApiSettingModel $apiSettingModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
        $this->favoriteModel = new FavoriteCountryModel();
        $this->apiSettingModel = new ApiSettingModel();
    }

    public function index(): string
    {
        if (! session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $apiSetting = $this->apiSettingModel->getActiveApi();
        $apiStatus = 'Tidak Dikonfigurasi';
        $totalCountries = 0;

        if ($apiSetting) {
            try {
                $countries = (new CountryApiService())->getAll($apiSetting['base_url']);
                $totalCountries = count($countries);
                $apiStatus = 'Connected';
            } catch (\Throwable $e) {
                $apiStatus = 'Error';
                log_message('error', 'Dashboard API check failed: ' . $e->getMessage());
            }
        }

        $data = [
            'title'            => 'Dashboard',
            'active_menu'      => 'dashboard',
            'total_favorites'  => $this->favoriteModel->countFavorites(),
            'total_countries'  => $totalCountries,
            'api_status'       => $apiStatus,
            'api_setting'      => $apiSetting,
            'recent_favorites' => $this->favoriteModel->getRecent(5),
        ];

        return view('layouts/admin_layout', [
            'content'     => view('dashboard/index', $data),
            'title'       => 'Dashboard - WorldInfo',
            'active_menu' => 'dashboard',
        ]);
    }
}
