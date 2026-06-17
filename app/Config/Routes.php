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

$routes->get('produk/tambah', 'ProdukController::create');

$routes->post('produk/simpan', 'ProdukController::store');

$routes->get('produk/edit/(:num)', 'ProdukController::edit/$1');
$routes->post('produk/update/(:num)', 'ProdukController::update/$1');
$routes->get('/cart', 'CartController::index');

$routes->get('/cart/add/(:num)', 'CartController::add/$1');
$routes->get('cart/delete/(:num)', 'CartController::delete/$1');
$routes->get('cart/increase/(:num)', 'CartController::increase/$1');

$routes->get('cart/decrease/(:num)', 'CartController::decrease/$1');
$routes->get('checkout', 'CheckoutController::index');
$routes->get('checkout', 'CheckoutController::index');
$routes->post('checkout/store', 'CheckoutController::store');
$routes->get('checkout/success', 'CheckoutController::success');
$routes->get('province', 'RajaOngkirController::province');
$routes->get('city/(:num)', 'RajaOngkirController::city/$1');
$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);
// Rute API RajaOngkir dengan Namespace Lengkap (Wajib Seperti Ini)
$routes->get('api/provinsi', '\App\Controllers\TransaksiController::getProvinsi');
$routes->get('api/kota/(:num)', '\App\Controllers\TransaksiController::getKota/$1');
$routes->post('api/cost', '\App\Controllers\TransaksiController::getCost');
