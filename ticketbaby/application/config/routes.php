<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "front";
$route['admin']='admin/admin_home';
$route['admin/(:any)'] = 'admin/$1';

$route['admin/login'] = 'login_form/index';

//$route['admin/ip_management)'] = 'ip_management/index';

$route['404_override'] = '';


$route['contact-us'] = 'front/contact';
$route['services'] = 'front/services';

$route['testemail'] = 'front/emailtest';

$route['eticket/(:any)'] = 'front/eticket/$1';

$route['pdf/(:any)'] = 'front/pdf/$1';

$route['about'] = 'front/about';
$route['blog'] = 'front/blog';

$route['gallery'] = "front/gallery";
$route['gallery/(:any)'] = "front/gallery/$1";
$route['gallery/(:any)/(:any)'] = "front/gallery/$1/$1";

$route['gallery-image/(:any)'] = "front/gallery_img/$1";


require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$query = $db->get('tbl_route');
$result = $query->result();
foreach( $result as $row )
{
    $route[ $row->slug ]                 = $row->route;
    $route[ $row->slug.'/:any' ]         = $row->route;
    $route[ $row->route ]           = 'error404';
    $route[ $row->route.'/:any' ]   = 'error404';
}


$route['logout']="logout/logout_me";

/* End of file routes.php */
/* Location: ./application/config/routes.php */