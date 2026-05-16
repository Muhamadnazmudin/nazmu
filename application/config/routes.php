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
$route['default_controller']
= 'home';

$route['404_override']
= 'errors/page_missing';

$route['translate_uri_dashes']
= FALSE;

/* AUTH */
/* AUTH */

/*
|--------------------------------------------------------------------------
| Login Rahasia
|--------------------------------------------------------------------------
*/

$route['asup']
= 'auth';

/*
|--------------------------------------------------------------------------
| Block public login
|--------------------------------------------------------------------------
*/

$route['login']
= 'errors/page_missing';

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

$route['logout']
= 'auth/logout';

/* ADMIN */
$route['admin']
= 'admin/dashboard';

$route['admin/menu']
= 'admin/menu/index';

$route['admin/menu/store']
= 'admin/menu/store';

$route['admin/menu/delete/(:num)']
= 'admin/menu/delete/$1';

$route['admin/media']
= 'admin/media/index';

$route['admin/comments']
= 'admin/comments/index';

$route['admin/settings']
= 'admin/settings';

$route['admin/settings/update']
= 'admin/settings/update';

/* ======================
   PAGES
====================== */

$route['admin/pages']
= 'admin/pages/index';

$route['admin/pages/create']
= 'admin/pages/create';

$route['admin/pages/store']
= 'admin/pages/store';

$route['admin/pages/edit/(:num)']
= 'admin/pages/edit/$1';

$route['admin/pages/update/(:num)']
= 'admin/pages/update/$1';

$route['admin/pages/delete/(:num)']
= 'admin/pages/delete/$1';
/* USERS */
$route['admin/users']
= 'admin/users/index';

$route['admin/users/create']
= 'admin/users/create';

$route['admin/users/store']
= 'admin/users/store';

$route['admin/users/edit/(:num)']
= 'admin/users/edit/$1';

$route['admin/users/update/(:num)']
= 'admin/users/update/$1';

$route['admin/users/delete/(:num)']
= 'admin/users/delete/$1';

/* SLIDERS */
$route['admin/sliders']
= 'admin/sliders/index';

$route['admin/sliders/create']
= 'admin/sliders/create';

$route['admin/sliders/store']
= 'admin/sliders/store';

$route['admin/sliders/edit/(:num)']
= 'admin/sliders/edit/$1';

$route['admin/sliders/update/(:num)']
= 'admin/sliders/update/$1';

$route['admin/sliders/delete/(:num)']
= 'admin/sliders/delete/$1';

/* SEO */
$route['admin/seo']
= 'admin/seo/index';

$route['admin/seo/update']
= 'admin/seo/update';

/* TUTORIAL */
$route['admin/tutorials']
= 'admin/tutorials/index';

$route['admin/tutorials/create']
= 'admin/tutorials/create';

$route['admin/tutorials/store']
= 'admin/tutorials/store';

$route['admin/tutorials/edit/(:num)']
= 'admin/tutorials/edit/$1';

$route['admin/tutorials/update/(:num)']
= 'admin/tutorials/update/$1';

$route['admin/tutorials/delete/(:num)']
= 'admin/tutorials/delete/$1';

/* ADS */
$route['admin/ads']
= 'admin/ads/index';

$route['admin/ads/update']
= 'admin/ads/update';


/*
|--------------------------------------------------------------------------
| ADMIN SCRAP IJAZAH
|--------------------------------------------------------------------------
*/

$route['admin/scrapijazah']
=
'admin/ScrapIjazah/index';

$route['admin/scrapijazah/schools']
=
'admin/ScrapIjazah/schools';

$route['admin/scrapijazah/logs']
=
'admin/ScrapIjazah/logs';

$route['admin/scrapijazah/delete-school/(:num)']
=
'admin/ScrapIjazah/delete_school/$1';
$route['admin/scrapijazah/delete_school/(:num)']
=
'admin/ScrapIjazah/delete_school/$1';


/* BLOG */
$route['blog/(:any)']
= 'blog/detail/$1';

$route['category/(:any)']
= 'category/index/$1';

$route['articles']
= 'articles/index';
$route['artikel']
= 'articles';

$route['search']
= 'search/index';

$route['comment/store']
= 'comment/store';


$route['download-center']
= 'download/index';

$route['download-center/file/(:any)']
= 'download/file/$1';

$route['download-center/view/(:any)']
= 'download/view/$1';

$route['download-center/category/(:any)']
= 'download/category/$1';

/*
|--------------------------------------------------------------------------
| Scrap Ijazah
|--------------------------------------------------------------------------
*/

$route['scrap-ijazah']
=
'ScrapIjazah/index';

$route['scrap-ijazah/process']
=
'ScrapIjazah/process';

$route['scrap-ijazah/download']
=
'ScrapIjazah/download';

/*
|--------------------------------------------------------------------------
| SEO
|--------------------------------------------------------------------------
*/

$route['sitemap.xml']
= 'sitemap/index';

$route['robots.txt']
= 'robots/index';

/*
|--------------------------------------------------------------------------
| Tutorial
|--------------------------------------------------------------------------
*/
$route['tutorial']
= 'tutorial/index';

$route['tutorial/(:any)']
= 'tutorial/detail/$1';

$route['theme/change/(:any)']
= 'theme/change/$1';

$route['theme/reset']
= 'theme/reset';

/*
|--------------------------------------------------------------------------
| Kontak / Request
|--------------------------------------------------------------------------
*/

$route['kontak']
= 'kontak/index';

$route['kontak/send']
= 'kontak/send';
$route['testwa']
= 'testwa/index';
/* UNIVERSAL PAGE */
/* HARUS PALING BAWAH */
$route['(:any)']
= 'page/view/$1';