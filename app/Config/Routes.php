<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//auth
$routes->get('/', 'Auth::login');
$routes->post('/check', 'Auth::checkLogin');
$routes->get('/logout', 'Auth::logout');
$routes->get('/register', 'Auth::register');
$routes->post('/register/create', 'Auth::createUser');


//admin->dashboard
$routes->get('/dashboard', 'Admin::index');


//admin->pegawai
$routes->get('/pegawai', 'Admin::pegawai');
$routes->get('/tambahPegawai', 'Admin::tambahPeg');
$routes->post('/pegawai/create', 'Admin::createPeg');
$routes->post('/pegawai/edit', 'Admin::editPeg');
$routes->post('/pegawai/delete', 'Admin::delete');


//admin->meja
$routes->get('/meja', 'Admin::meja');
$routes->post('/meja/create', 'Admin::createMeja');
$routes->post('/meja/edit', 'Admin::editMeja');

//admin->menu
$routes->get('/menu', 'Admin::menu');



//manager->dashboard
$routes->get('/manager', 'Manager::index');

//manager->menu
$routes->get('/menuMan', 'Manager::menu');
$routes->get('/tambahMenu', 'Manager::tambahMenu');
$routes->post('/menu/create', 'Manager::createMenu');
$routes->post('/menu/edit', 'Manager::editMenu');

//manager->transaksi
$routes->get('/transaksiMan', 'Manager::transaksi');

//manager->pegawai
$routes->get('/pegawaiMan', 'Manager::pegawai');



//Kasir->dashboard
$routes->get('/kasir', 'Kasir::index');

//kasir->transaksi
$routes->get('/transaksi', 'Kasir::transaksi');
$routes->get('/tambahTransaksi', 'Kasir::tambahTrans');

//kasir->pemesanan
$routes->get('/pemesanan', 'Kasir::pemesanan');
$routes->get('/pesanMenu', 'Kasir::pesan');
$routes->get('/keranjang/(:num)', 'Kasir::keranjang');
$routes->post('/pesanMenu/create', 'Kasir::createPesan');

//kasir->bayar
$routes->get('/bayar/(:num)', 'Kasir::bayar/$1');
$routes->post('/bayar/(:num)/masuk', 'Kasir::bayaranMasuk');

//cetak->bil
$routes->post('/cetak/cetak_bill/(:num)', 'Cetak::cetak_bill/$id');


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
