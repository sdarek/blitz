<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/ProductController.php';

class Routing {
    public static $routes;

    public static function get($url, $controller) {
        self::$routes[$url] = $controller;
    }
    public static function post($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function run($url) {
        $urlParts = explode("/", $url);
        $i = 0;
        if ($urlParts[1] == "updateCartItem") {
            $i++;
        }
        $action = $urlParts[$i];

        if(!array_key_exists($action, self::$routes)) {
            die("Wrong url!");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $id = (int)$urlParts[$i+1] ?? '';
        $quantity = intval($urlParts[$i+2] ?? '');

        $object->$action($id, $quantity);
        
    }
}