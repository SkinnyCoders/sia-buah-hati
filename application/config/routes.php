<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['alumni/auth'] = 'front/auth/login';
$route['admin'] = 'admin/auth/login';
$route['tatausaha'] = 'tatausaha/auth/login';
$route['pegawai'] = 'pegawai/auth/login';
$route['administrator'] = 'front/administrator/login';
$route['event'] = 'front/event';
$route['event/detail/(:any)'] = 'front/event/detail/$1';
$route['lowongan/detail/(:any)'] = 'front/lowongan/detail/$1';


/* Home routing */

//pendaftaran
// $route['petunjuk-pendaftaran'] = 'c_home/pendaftaran/petunjuk';
// $route['jalur-pendaftaran'] = 'c_home/pendaftaran/jalur';
// $route['biaya-pendaftaran'] = 'c_home/pendaftaran/biaya';
// $route['beasiswa'] = 'c_home/pendaftaran/beasiswa';

// //tentang kami
// $route['profil'] = 'c_home/about/profile';
// $route['fasilitas'] = 'c_home/about/facility';
// $route['penghargaan'] = 'c_home/about/achivment';

// 

// //informasi
// $route['faq'] = 'c_home/informasi/faq';
// $route['pengumuman'] = 'c_home/informasi/pengumuman';

// //login
// $route['login'] = 'c_home/login';

// //login admin
// $route['admin/login'] = 'auth/login';

// //registrasi
// $route['registrasi/(:any)'] = 'c_home/registrasi';
// $route['registrasi'] = 'c_home/registrasi';

// //dashboard routing
// $route['admin'] = 'admin/dashboard';
// $route['operator'] = 'operator/dashboard';
// $route['kepsek'] = 'kepsek/dashboard';
// $route['peserta'] = 'peserta/dashboard';

// //seleksi 
// $route['operator/soal-seleksi'] = 'operator/seleksi';
// $route['operator/soal-seleksi/tambah'] = 'operator/seleksi/add';
// $route['operator/soal-seleksi/ubah/(:any)'] = 'operator/seleksi/update/$1';
// $route['operator/soal-seleksi/detail/(:any)'] = 'operator/seleksi/detail/$1';
// $route['operator/soal-seleksi/detail/tambah_soal/(:any)'] = 'operator/seleksi/add_soal/$1';
// $route['operator/soal-seleksi/konfigurasi'] = 'operator/seleksi/konfigurasi';


/* end home routing */
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
