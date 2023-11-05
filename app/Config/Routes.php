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
  $routes->get('Rank/Add', 'AdmController::tambah_alt');

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
  $routes->get('MataPelajaran/(:num)', 'AdmController::mapel_delete/$1');
  $routes->post('MataPelajaran', 'AdmController::mapel_add');
  $routes->post('MataPelajaran/Edit', 'AdmController::mapel_edit');

  $routes->get('Kelas', 'AdmController::kelas');
  $routes->post('Kelas', 'AdmController::kelas_add');
  $routes->post('Kelas/Edit', 'AdmController::kelas_edit');
  $routes->get('Kelas/(:num)', 'AdmController::kelas_delete/$1');
  $routes->get('Kelas/Mapel/(:num)', 'AdmController::kelas_mapel/$1');
  $routes->get('Kelas/Mapel/delete/(:num)', 'AdmController::kelas_mapel_delete/$1');
  $routes->post('Kelas/Mapel', 'AdmController::kelas_mapel_add');

  $routes->get('Laporan', 'AdmController::laporan');
});

$routes->group('SiswaPanel', ['namespace' => 'App\Controllers'], function (RouteCollection $routes) {
  $routes->get('/', 'SiswaController::index');

});