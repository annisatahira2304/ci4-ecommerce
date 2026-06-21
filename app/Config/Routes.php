<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('produk', 'ProdukController::index', ['filter' => 'auth']);

$routes->get('keranjang', 'TransaksiController::index', ['filter' => 'auth']);

$routes->get('kontak', 'KontakController::index', ['filter' => 'auth']);


// LOGIN
$routes->get('login', 'AuthController::login');

$routes->post('login', 'AuthController::login');


// LOGOUT
$routes->get('logout', 'AuthController::logout');

$routes->get('produk/edit/(:num)', 'ProdukController::edit/$1');

$routes->post('produk/update/(:num)', 'ProdukController::update/$1');

$routes->post('produk/delete/(:num)', 'ProdukController::delete/$1');
$routes->get('produk/download', 'ProdukController::download');

$routes->post('produk/simpan', 'ProdukController::store');

$routes->get('/cart', 'CartController::index');
$routes->get('/cart/add/(:num)', 'CartController::add/$1');
$routes->post('cart/add-ajax', 'CartController::addAjax');
$routes->get('cart/count', 'CartController::getCount');
$routes->get('cart/delete/(:num)', 'CartController::delete/$1');
$routes->get('cart/increase/(:num)', 'CartController::increase/$1');
$routes->get('cart/decrease/(:num)', 'CartController::decrease/$1');
$routes->get('cart/items-ajax', 'CartController::getItemsAjax');
$routes->post('cart/increase-ajax/(:num)', 'CartController::increaseAjax/$1');
$routes->post('cart/decrease-ajax/(:num)', 'CartController::decreaseAjax/$1');
$routes->post('cart/delete-ajax/(:num)', 'CartController::deleteAjax/$1');
$routes->post('checkout/store', 'CheckoutController::store');
$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->get('checkout/partial', 'CheckoutController::getCheckoutPartial');
$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);
// Rute API RajaOngkir dengan Namespace Lengkap (Wajib Seperti Ini)
$routes->get('api/provinsi', '\App\Controllers\TransaksiController::getProvinsi');
$routes->get('api/kota', '\App\Controllers\TransaksiController::getLocation');
$routes->post('api/cost', '\App\Controllers\TransaksiController::getCost');
$routes->get('profil', 'Profil::index', ['filter' => 'auth']);
$routes->post('upload-bukti', 'TransaksiController::uploadBukti', ['filter' => 'auth']);

// LAPORAN
$routes->get('laporan/pendapatan', 'LaporanController::pendapatan', ['filter' => 'auth']);
$routes->get('laporan/exportPdf', 'LaporanController::exportPdf', ['filter' => 'auth']);
$routes->get('laporan/exportExcel', 'LaporanController::exportExcel', ['filter' => 'auth']);


// PENJUALAN
$routes->get('penjualan', 'TransaksiController::penjualan', ['filter' => 'auth']);
$routes->post('penjualan/updateStatus/(:num)', 'TransaksiController::updateStatus/$1', ['filter' => 'auth']);
