<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// ============================================
// ADMIN ROUTES (specific first, then general)
// ============================================

// Admin > Paket (parameterized routes MUST come before general)
$route['admin/paket/edit/(:num)']     = 'admin/paket_edit/$1';
$route['admin/paket/hapus/(:num)']    = 'admin/paket_hapus/$1';
$route['admin/paket/tambah']          = 'admin/paket_tambah';

// Admin > Users
$route['admin/users/toggle/(:num)']   = 'admin/users_toggle/$1';

// Admin > Transaksi
$route['admin/transaksi/konfirmasi/(:num)'] = 'admin/transaksi_konfirmasi/$1';
$route['admin/transaksi/batalkan/(:num)']   = 'admin/transaksi_batalkan/$1';

// Admin > Nilai
$route['admin/nilai/(:num)']          = 'admin/nilai/$1';

// Admin > Kriteria
$route['admin/kriteria/edit/(:num)']  = 'admin/kriteria_edit/$1';

// Admin > Kategori Program
$route['admin/kategori/edit/(:num)']     = 'admin/kategori_edit/$1';
$route['admin/kategori/hapus/(:num)']    = 'admin/kategori_hapus/$1';
$route['admin/kategori/tambah']          = 'admin/kategori_tambah';

// Admin > Destinasi (pagination route MUST come before specific routes)
$route['admin/destinasi/(:num)']         = 'admin/destinasi/$1';
$route['admin/destinasi/edit/(:num)']    = 'admin/destinasi_edit/$1';
$route['admin/destinasi/hapus/(:num)']   = 'admin/destinasi_hapus/$1';
$route['admin/destinasi/tambah']         = 'admin/destinasi_tambah';

// Admin > Fasilitas
$route['admin/fasilitas/edit/(:num)']    = 'admin/fasilitas_edit/$1';
$route['admin/fasilitas/hapus/(:num)']   = 'admin/fasilitas_hapus/$1';
$route['admin/fasilitas/tambah']         = 'admin/fasilitas_tambah';

// Admin > Klien
$route['admin/klien/edit/(:num)']        = 'admin/klien_edit/$1';
$route['admin/klien/hapus/(:num)']       = 'admin/klien_hapus/$1';
$route['admin/klien/tambah']             = 'admin/klien_tambah';

// Admin > Aktivitas
$route['admin/aktivitas/edit/(:num)']    = 'admin/aktivitas_edit/$1';
$route['admin/aktivitas/hapus/(:num)']   = 'admin/aktivitas_hapus/$1';
$route['admin/aktivitas/tambah']         = 'admin/aktivitas_tambah';

// Admin > Dashboard (alias)
$route['admin']                       = 'admin/dashboard';

// ============================================
// AUTH ROUTES
// ============================================
$route['auth/forgot_password']     = 'auth/forgot_password';
$route['auth/reset_password/(:any)'] = 'auth/reset_password/$1';

// ============================================
// PEMESANAN ROUTES (parameterized first)
// ============================================
$route['pemesanan/booking/(:num)']    = 'pemesanan/booking/$1';
$route['pemesanan/invoice/(:num)']    = 'pemesanan/invoice/$1';

// ============================================
// PAKET ROUTES
// ============================================
$route['paket/detail/(:num)']         = 'paket/detail/$1';

// ============================================
// REKOMENDASI ROUTES
// ============================================
// Default CI3 routing handles rekomendasi/index and rekomendasi/hasil

// ============================================
// PUBLIC PAGES
// ============================================
$route['clients'] = 'home/clients';
$route['program'] = 'home/program';
