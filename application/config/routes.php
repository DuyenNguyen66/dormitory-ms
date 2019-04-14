<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'index/index';
$route['login'] = 'index/login';
$route['register'] = 'index/register';

$route['registration'] = 'register/index';
$route['chooseRoom'] = 'register/chooseRoom';
$route['register-list'] = 'register/registerList';
$route['roommate-list'] = 'register/roommateList';

