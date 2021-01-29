<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//------------------------------------------------ROUTES FOR FRONT-------------------------------------------
$route['client-login'] = 'home/login';
$route['client-forget-password'] = 'home/forget_form';
$route['client-register'] = 'home/register';
$route['client-profile'] = 'home/profile';
$route['client-list/(:any)'] = 'home/lists/$1';
$route['client-view/(:any)/(:any)'] = 'home/view/$1/$1';
$route['client-view-update/(:any)/(:any)'] = 'home/read_status_view/$1/$1';
$route['client-add/(:any)'] = 'home/add/$1';
$route['client-add_data/(:any)'] = 'home/add_data/$1';
$route['client-edit/(:any)/(:any)'] = 'home/edit/$1/$1';
$route['client-update-data/(:any)/(:any)'] = 'home/update_data/$1/$1';
$route['client-delete/(:any)/(:any)'] = 'home/delete/$1/$1';
$route['registration'] = 'home/registration';
//------------------------------------------------ROUTES FOR ADMIN-------------------------------------------

$route['login'] = 'admin/login';

$route['admin-support/(:any)'] = 'admin/get_client_support/$1';

$route['list-support'] = 'admin/get_list_support';
$route['forget-password'] = 'admin/forget_form';
$route['register'] = 'admin/register';
$route['profile'] = 'admin/profile';
$route['list/(:any)'] = 'admin/lists/$1';
$route['view/(:any)/(:any)'] = 'admin/view/$1/$1';
$route['view-update/(:any)/(:any)'] = 'admin/read_status_view/$1/$1';
$route['add/(:any)'] = 'admin/add/$1';
$route['add_data/(:any)'] = 'admin/add_data/$1';
$route['edit/(:any)/(:any)'] = 'admin/edit/$1/$1';
$route['update_data/(:any)/(:any)'] = 'admin/update_data/$1/$1';
$route['delete/(:any)/(:any)'] = 'admin/delete/$1/$1';

//------------------------------------------------ROUTES FOR MEMBERS-------------------------------------------
