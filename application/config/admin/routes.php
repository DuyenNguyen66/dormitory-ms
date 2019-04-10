<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['dashboard'] = 'index/index';
$route['login'] = 'index/login';
$route['logout'] = 'index/logout';
$route['register'] = 'index/register';

$route['building'] = 'building/index';
$route['room'] = 'room/index';
$route['manager'] = 'index/getManagersList';
$route['student'] = 'student/index';