<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'index/index';
$route['login'] = 'index/login';
$route['logout'] = 'index/logout';
$route['register'] = 'index/register';

$route['registration'] = 'register/index';
$route['register-list'] = 'register/registerList';
$route['roommate-list'] = 'register/roommateList';

