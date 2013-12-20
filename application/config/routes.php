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

$route['default_controller'] = "home";
$route['404_override'] = '';


$route['user/inventionslist'] = 'user/home/inventionslist';
$route['user/invention/:any'] = "user/home/invention";
$route['user/invention1/:any'] = "user/home/invention1";
$route['user/invention2/:any'] = "user/home/invention2";
$route['user/invention3/:any'] = "user/home/invention3";
$route['user/invention4/:any'] = "user/home/invention4";
$route['user/invention5/:any'] = "user/home/invention5";
$route['user/invention6/:any'] = "user/home/invention6";
$route['user/score/:any'] = "user/home/score";
$route['user/complete/:any'] = "user/home/complete";
$route['user/download/:any'] = "user/home/download";
$route['user/deleteinvention/:any'] = "user/home/deleteinvention";
$route['user/logout'] = "user/home/logout";
$route['admin/userlist'] = "admin/home/userlist";
$route['admin/add_user'] = "admin/home/add_user";
$route['admin/edit_user:any'] = "admin/home/edit_user";

/* End of file routes.php */
/* Location: ./application/config/routes.php */