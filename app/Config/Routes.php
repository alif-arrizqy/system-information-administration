<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Login
$routes->get('Login', 'Login::index');


// User
// Main
$routes->get('/Home', 'Main::index', ['filter' => 'auth']);

// proposal
$routes->get('/submit_proposal', 'Proposal::submit_proposal', ['filter' => 'auth']);
$routes->get('/list_proposal', 'Proposal::list_proposal', ['filter' => 'auth']);
$routes->get('/approve_proposal', 'Proposal::approve_proposal', ['filter' => 'auth']);

// laporan_hasil_kegiatan
$routes->get('/submit_laporan_hasil_kegiatan', 'LaporanKegiatan::submit_laporan_hasil_kegiatan', ['filter' => 'auth']);
$routes->get('/list_laporan_hasil_kegiatan', 'LaporanKegiatan::list_laporan_hasil_kegiatan', ['filter' => 'auth']);

// persuratan
$routes->get('/submit_surat', 'Surat::submit_surat', ['filter' => 'auth']);
$routes->get('/list_surat_masuk', 'Surat::list_surat_masuk', ['filter' => 'auth']);
$routes->get('/list_surat_keluar', 'Surat::list_surat_keluar', ['filter' => 'auth']);

// pelaksanaan
// rekap
$routes->get('/realisasi_kegiatan', 'Pelaksanaan::realisasi_kegiatan', ['filter' => 'auth']);
$routes->get('/detail_realisasi_kegiatan/(:segment)', 'Pelaksanaan::detail_realisasi_kegiatan/$1', ['filter' => 'auth']);
// per lembaga
$routes->get('/realisasi_kegiatan_lembaga/(:segment)', 'Pelaksanaan::realisasi_kegiatan_kelembagaan/$1', ['filter' => 'auth']);
$routes->get('/detail_realisasi_kegiatan_lembaga/(:segment)', 'Pelaksanaan::realisasi_kegiatan_kelembagaan/$1', ['filter' => 'auth']);

// kelembagaan mhs dan anggaran
$routes->get('/submit_lembaga/(:segment)', 'KelembagaanAnggaran::submit_lembaga/$1', ['filter' => 'auth']);
$routes->get('/list_lembaga/(:segment)', 'KelembagaanAnggaran::list_lembaga/$1', ['filter' => 'auth']);

// dana subsidi
$routes->get('/submit_dana_subsidi', 'DanaSubsidi::submit_dana_subsidi', ['filter' => 'auth']);
$routes->get('/list_dana_subsidi', 'DanaSubsidi::list_dana_subsidi', ['filter' => 'auth']);
$routes->get('/approve_dana_subsidi', 'DanaSubsidi::approve_dana_subsidi', ['filter' => 'auth']);

// manajemen user
$routes->get('/list_users', 'Users::list_users', ['filter' => 'auth']);
$routes->get('/view_users', 'Users::view_users', ['filter' => 'auth']);
$routes->get('/submit_users', 'Users::submit_users', ['filter' => 'auth']);



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
