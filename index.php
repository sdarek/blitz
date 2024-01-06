<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('home', 'DefaultController');
Routing::get('shop', 'ProductController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('addProduct', 'ProductController');
Routing::run($path);