<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// ---------------- ADMIN ROUTES ----------------
$routes->group('admin', ['namespace' => 'App\Controllers\admin'], function ($routes) {
    $routes->get('/', 'AuthController::login');
    $routes->post('login', 'AuthController::processLogin');
    $routes->get('main', 'Home::index');
    $routes->get('logout', 'AuthController::logout');
    $routes->get('api/getChartData', 'ApiController::getChartData');
    $routes->get('api/getDinluPegawai', 'ApiController::getDinluPegawai');
    $routes->get('api/getDinluBidang', 'ApiController::getDinluBidang');
    $routes->get('api/getPegawaiPNS', 'ApiController::getPegawaiPNS');
    $routes->get('api/getBidangList', 'ApiController::getBidangList');
    $routes->get('api/getPegawaiNonPNS', 'ApiController::getPegawaiNonPNS');
    $routes->get('api/getDinasLuarData', 'ApiController::getDinasLuarData');
    $routes->get('laporan/export', 'ApiController::exportLaporanBulanan');
});

// ---------------- USER ROUTES ----------------
$routes->group('user', ['namespace' => 'App\Controllers\user'], function ($routes) {
    $routes->get('/', 'Auth::login');
    $routes->get('login', 'Auth::login');
    $routes->post('login/process', 'Auth::loginProcess');
    $routes->get('auth/register', 'Auth::register');
    $routes->get('register', 'Auth::register');
    $routes->post('register/process', 'Auth::registerProcess');
    $routes->post('register/store', 'Auth::registerProcess');
    $routes->get('logout', 'Auth::logout');
    $routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);
    $routes->get('dinasluar', 'DinasLuar::index', ['filter' => 'auth']);
    $routes->post('dinasluar/simpan', 'DinasLuar::simpan', ['filter' => 'auth']);
    $routes->get('dinasluar/edit/(:num)', 'DinasLuar::edit/$1');
    $routes->post('dinasluar/update/(:num)', 'DinasLuar::update/$1');
    $routes->post('dinasluar/hapus/(:num)', 'DinasLuar::hapus/$1');

    $routes->get('api/getChartData', 'Dashboard::getChartData', ['filter' => 'auth']);
});
