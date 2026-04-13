<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = 'blog';
$route['404_override'] = '';

$route['blog'] = 'blog/index';
$route['blog/(:any)'] = 'blog/view/$1';

$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';

$route['admin'] = 'admin/index';
$route['admin/posts/create'] = 'admin/create';
$route['admin/posts/edit/(:num)'] = 'admin/edit/$1';
$route['admin/posts/delete/(:num)'] = 'admin/delete/$1';
