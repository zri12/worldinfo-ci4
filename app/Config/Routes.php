<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 *
 * WorldInfo – Routes Configuration
 * Semua routing aplikasi WorldInfo didefinisikan di sini.
 */

// ============================================================
// PUBLIC ROUTES – Bisa diakses tanpa login
// ============================================================

// Landing Page
$routes->get('/', 'CountryController::landing');
$routes->get('/landing', 'CountryController::landing');

// Daftar Negara (publik)
$routes->get('/countries', 'CountryController::index');

// Detail Negara (publik)
$routes->get('/countries/detail/(:segment)', 'CountryController::detail/$1');

// ============================================================
// AUTH ROUTES
// ============================================================

$routes->get('/login', 'AuthController::login');
$routes->post('/login/process', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');

// ============================================================
// ADMIN ROUTES – Memerlukan login
// ============================================================

// Dashboard
$routes->get('/dashboard', 'DashboardController::index');

// Data negara dalam panel admin
$routes->get('/admin/countries', 'CountryController::adminIndex');

// CRUD negara kelolaan admin
$routes->get('/admin/managed-countries', 'ManagedCountryController::index');
$routes->get('/admin/managed-countries/create', 'ManagedCountryController::create');
$routes->post('/admin/managed-countries/store', 'ManagedCountryController::store');
$routes->get('/admin/managed-countries/edit/(:num)', 'ManagedCountryController::edit/$1');
$routes->post('/admin/managed-countries/update/(:num)', 'ManagedCountryController::update/$1');
$routes->post('/admin/managed-countries/delete/(:num)', 'ManagedCountryController::delete/$1');

// Favorit Negara – CRUD
$routes->get('/favorites', 'FavoriteController::index');
$routes->get('/favorites/create', 'FavoriteController::create');
$routes->post('/favorites/store', 'FavoriteController::store');
$routes->get('/favorites/edit/(:num)', 'FavoriteController::edit/$1');
$routes->post('/favorites/update/(:num)', 'FavoriteController::update/$1');
$routes->get('/favorites/delete/(:num)', 'FavoriteController::delete/$1');

// Pengaturan API – CRUD + Test + Sync
$routes->get('/api-settings', 'ApiSettingController::index');
$routes->get('/api-settings/countries', 'ApiSettingController::countries');
$routes->post('/api-settings/store', 'ApiSettingController::store');
$routes->post('/api-settings/test', 'ApiSettingController::testApi');
$routes->post('/api-settings/sync', 'ApiSettingController::sync');
$routes->post('/api-settings/update/(:num)', 'ApiSettingController::update/$1');
$routes->get('/api-settings/delete/(:num)', 'ApiSettingController::delete/$1');

// Tentang Website
$routes->get('/about', 'AboutController::index');
