<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('Adm/Login', 'AdminLogin::index');
$routes->get('Adm/Destroy', 'AdminLogin::logout');
$routes->post('Adm/Login', 'AdminLogin::auth');

$routes->get('Login', 'SiswaLogin::index');
$routes->get('Destroy', 'SiswaLogin::logout');
$routes->post('Login', 'SiswaLogin::auth');

$routes->group('AdmPanel', ['namespace' => 'App\Controllers'], function (RouteCollection $routes) {
  $routes->get('/', function () {
    return redirect()->to(base_url('AdmPanel/Rank'));
  });

  $routes->get('Rank', 'AdmController::index');
  $routes->get('Kriteria', 'AdmController::kriteria');
  $routes->get('Siswa', 'AdmController::siswa');
  $routes->get('MataPelajaran', 'AdmController::mapel');
  $routes->get('Kelas', 'AdmController::kelas');
  $routes->get('Laporan', 'AdmController::laporan');
});

$routes->group('Panel', ['namespace' => 'App\Controllers'], function (RouteCollection $routes) {
  $routes->get('/', 'SiswaController::index');

});