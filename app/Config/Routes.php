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
  $routes->post('Kriteria', 'AdmController::kriteria_create');
  $routes->post('Kriteria/Edit', 'AdmController::kriteria_edit');
  $routes->get('Kriteria/(:num)', 'AdmController::kriteria_delete/$1');

  $routes->get('Siswa', 'AdmController::siswa');
  $routes->post('Siswa', 'AdmController::siswa_add');
  $routes->post('Siswa/Edit', 'AdmController::siswa_edit');
  $routes->post('Siswa/Pwd', 'AdmController::siswa_password');
  $routes->get('Siswa/(:num)', 'AdmController::siswa_delete/$1');

  $routes->get('MataPelajaran', 'AdmController::mapel');
  $routes->get('Kelas', 'AdmController::kelas');
  $routes->get('Laporan', 'AdmController::laporan');
});

$routes->group('SiswaPanel', ['namespace' => 'App\Controllers'], function (RouteCollection $routes) {
  $routes->get('/', 'SiswaController::index');

});