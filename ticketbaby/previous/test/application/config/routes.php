<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 error_reporting(E_ALL ^ E_NOTICE);
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

$route['admin/ticket'] 			= 'admin/ticket';
$route['admin/ticket/edit']   	= 'admin/ticket/edit';
$route['admin/ticket/(:num)'] 	= 'admin/ticket';

$route['admin/ticket/event']   	   			= 'admin/ticket/event';
$route['admin/ticket/event_ticket_edit']    = 'admin/ticket/event_ticket_edit';


$route['admin/event'] 		 = 'admin/event';
$route['admin/event/edit']   = 'admin/event/edit';
$route['admin/event/delete']   = 'admin/event/delete';
$route['admin/event/userpaidevent']   = 'admin/event/userpaidevent';
$route['admin/event/getStatesList'] 		 	 = 'admin/event/getStatesList';
$route['admin/event/getCitiesList'] 		 	 = 'admin/event/getCitiesList';
$route['admin/event/(:num)'] = 'admin/event';
$route['admin/event/(:any)'] = 'admin/event/view';


$route['admin/event/promote']   = 'admin/event/promote';
$route['admin/event/promote/delete']   = 'admin/event/promote_delete';



$route['admin/coupon'] 		  	= 'admin/coupon';
$route['admin/coupon/delete'] 	= 'admin/coupon/delete';


$route['admin/page'] 			= 'admin/page';
$route['admin/page/edit']  		= 'admin/page/edit';
$route['admin/page/(:num)'] 	= 'admin/page';
$route['admin/page/(:any)'] 	= 'admin/page/view';
$route['admin/page/changeadvertisementvideo']  		= 'admin/page/changeAdvertisementVideo';


$route['admin/order'] 			= 'admin/order';
$route['admin/order/edit']  	= 'admin/order/edit';
$route['admin/order/export'] 			= 'admin/order/export';
$route['admin/order/(:num)'] 	= 'admin/order';
$route['admin/order/(:any)'] 	= 'admin/order/view';

$route['admin/user'] 			= 'admin/user';
$route['admin/user/edit']  		= 'admin/user/edit';
$route['admin/user/export']  		= 'admin/user/export';
$route['admin/user/(:num)'] 	= 'admin/user';
$route['admin/user/(:any)'] 	= 'admin/user/view';


$route['admin/user/create'] 	= 'admin/user/create';
$route['admin/user/profile'] 	= 'admin/user/profile';
$route['admin/user/profile/(:any)'] = 'admin/user/view/$1';

$route['admin/client'] 			= 'admin/client';
$route['admin/client/edit']  		= 'admin/client/edit';
$route['admin/client/invite']  		= 'admin/client/invite';

$route['admin/event/booking']  		= 'admin/event/booking';
$route['admin/event/order'] 		 = 'admin/event/order';

$route['admin/event/success/(:any)'] = 'admin/event/success/$1';

$route['admin/client/(:num)'] 	= 'admin/client';
$route['admin/client/(:any)'] 	= 'admin/client/view';
$route['admin/client/download_csv'] 	= 'admin/client/download_csv';
$route['admin/client/import_csv'] 	= 'admin/client/import_csv';
$route['admin/setting'] = 'admin/setting';

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

$route['event/add_event'] 	 = 'event/add_event';
$route['event/preview'] 	 = 'event/preview';
$route['event/getStatesList'] 		 	 = 'event/getStatesList';
$route['event/getCitiesList'] 		 	 = 'event/getCitiesList';
$route['event'] 		 	 = 'event';
$route['event/search'] 		 = 'event/search_event';
$route['event/(:any)'] 		 = 'event/view/$1';
$route['event/(:any)/(:any)'] 		 = 'event/view/$1/$2';








$route['music'] 		 	 = 'music';
$route['music/(:any)'] 		 = 'music/view/$1';
$route['music/callpage'] 	 = 'music/callpage';
$route['theatre_arts/(:any)'] 		 = 'music/view/$1';

$route['user/order_edit/$1'] 		 = 'user/order_edit/$1';
$route['user/event_edit'] 		 = 'user/event_edit';

$route['user/my_event/(:any)'] 		 = 'user/my_event/$1';
$route['user/attend/(:any)/(:any)/(:any)/(:any)'] 		 = 'user/attend/$1/$2/$3/$4';
$route['user/preview/(:any)/(:any)/(:any)/(:any)'] 		 = 'user/preview/$1/$2/$3/$4';
$route['user/accept/(:any)'] 		 = 'user/accept/$1'; 
//$route['(:any)'] 			 = 'page/view/$1';
$route['(:any)'] = "page/loadPage/$1";


$route['index/contatus'] = 'index/contactus';


