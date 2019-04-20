<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['dashboard'] = 'index/index';
$route['login'] = 'index/login';
$route['logout'] = 'index/logout';
$route['register'] = 'index/register';

$route['building'] = 'building/index';
$route['room'] = 'room/index';
$route['room/assignment/(:num)'] = 'room/assignStudent/$1';

$route['manager'] = 'index/getManagersList';

$route['student'] = 'student/index';
$route['profile/(:num)'] = 'student/profile/$1';

$route['form'] = 'register/index';
