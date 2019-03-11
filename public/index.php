<?php
use Core\Router\Router;

$composerAutoLoadPath = dirname(__DIR__ ). '/vendor/autoload.php';
require_once $composerAutoLoadPath;

set_exception_handler('Core\Error\Error::exeptionHandler');
set_error_handler('Core\Error\Error::errorHandler');

$lifetIme = 0; 
$path = '/'; 
$domain =  $_SERVER['HTTP_HOST']; 
$secure = isset($_SERVER["HTTPS"]); 
$httponly = true;
session_set_cookie_params ($lifetIme, $path, $domain, $secure, $httponly);
session_start();

$url = $_SERVER['QUERY_STRING'];
$router = new Router();

$router->add('sign-up/activate-account/{activationToken:[\da-f]+}', ['controller' => 'sign-up', 'action' => 'activate-account']);
$router->add('', ['controller' => 'Home', 'action' => 'serve-home-page']);
$router->add('login', ['controller' => 'log-in', 'action' => 'serve-log-in-page']);
$router->add('signup', ['controller' => 'sign-up', 'action' => 'serve-sign-up-page']);
$router->add('{controller}/{action}');
$router->add('{controller}/{var:\d+}/{action}', ['monkey' => 'posts', 'post' => 'gorilla']);

$router->despatch($url);