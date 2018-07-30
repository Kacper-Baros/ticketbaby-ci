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
|	http://codeigniter.com/user_guide/general/routing.html
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
#$route['default_controller'] = 'welcome';
#$route['404_override'] = '';
#$route['translate_uri_dashes'] = FALSE;

# Back-end
$route['admin'] = 'admin/login';
$route['admin/logout'] = 'admin/logout';


$route['admin/category'] 		= 'admin/category';
$route['admin/category/edit']   = 'admin/category/edit';
$route['admin/category/(:num)'] = 'admin/category';


$route['admin/event'] 		 = 'admin/event';
$route['admin/event/edit']   = 'admin/event/edit';
$route['admin/event/(:num)'] = 'admin/event';
$route['admin/event/(:any)'] = 'admin/event/view';


$route['admin/page'] 			= 'admin/page';
$route['admin/page/edit']  		= 'admin/page/edit';
$route['admin/page/(:num)'] 	= 'admin/page';
$route['admin/page/(:any)'] 	= 'admin/page/view';


$route['admin/order'] 			= 'admin/order';
$route['admin/order/edit']  	= 'admin/order/edit';
$route['admin/order/(:num)'] 	= 'admin/order';
$route['admin/order/(:any)'] 	= 'admin/order/view';

$route['admin/user'] 			= 'admin/user';
$route['admin/user/edit']  		= 'admin/user/edit';
$route['admin/user/(:num)'] 	= 'admin/user';
$route['admin/user/(:any)'] 	= 'admin/user/view';


$route['admin/user/create'] 	= 'admin/user/create';
$route['admin/user/profile'] 	= 'admin/user/profile';
$route['admin/user/profile/(:any)'] = 'admin/user/view/$1';



$route['admin/setting'] = 'admin/setting';

/*
$route['admin/([a-zA-Z_-]+)/(:any)'] = '$1/admin/$2'; 
$route['admin/login'] = 'admin/login'; 
$route['admin/logout'] = 'admin/logout'; 
$route['admin/([a-zA-Z_-]+)'] = '$1/admin/index'; 
$route['admin'] = 'admin';
*/

# Front-end
$route['default_controller'] = 'Index';

$route['ajax'] = 'Ajax';
$route['ajax/(:any)'] = 'Ajax/$1';


$route['event'] 		 	 = 'event';
$route['event/(:any)'] 		 = 'event/view/$1';


$route['(:any)'] 			 = 'page/view/$1';



