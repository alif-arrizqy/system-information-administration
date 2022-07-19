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
$routes->get('/submit_proposal', 'Main::submit_proposal', ['filter' => 'auth']);
$routes->get('/list_proposal', 'Main::list_proposal', ['filter' => 'auth']);
$routes->get('/approve_proposal', 'Main::approve_proposal', ['filter' => 'auth']);

// laporan_hasil_kegiatan
$routes->get('/submit_laporan_hasil_kegiatan', 'Main::submit_laporan_hasil_kegiatan', ['filter' => 'auth']);
$routes->get('/list_laporan_hasil_kegiatan', 'Main::list_laporan_hasil_kegiatan', ['filter' => 'auth']);

// persuratan
$routes->get('/submit_surat', 'Main::submit_surat', ['filter' => 'auth']);
$routes->get('/list_surat_masuk', 'Main::list_surat_masuk', ['filter' => 'auth']);
$routes->get('/list_surat_keluar', 'Main::list_surat_keluar', ['filter' => 'auth']);

// pelaksanaan
$routes->get('/realisasi_kegiatan', 'Main::realisasi_kegiatan', ['filter' => 'auth']);
$routes->get('/detail_realisasi_kegiatan', 'Main::detail_realisasi_kegiatan', ['filter' => 'auth']);

// manajemen user
$routes->get('/list_admin', 'Main::list_admin', ['filter' => 'auth']);
$routes->get('/add_admin', 'Main::add_admin', ['filter' => 'auth']);
$routes->get('/list_user', 'Main::list_user', ['filter' => 'auth']);
$routes->get('/add_user', 'Main::add_user', ['filter' => 'auth']);



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
