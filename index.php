<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('home', 'DefaultController');
Routing::get('shop', 'ProductController');
Routing::get('shop_admin', 'ProductController');
Routing::post('login', 'SecurityController');
Routing::post('logout', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('addProduct', 'ProductController');
Routing::post('search', 'ProductController');
Routing::get('searchByCategory', 'ProductController');
Routing::run($path);