<?php 

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

spl_autoload_register( function (string $class_name) {

    require "src/" . str_replace("\\", "/", $class_name) . ".php";

});

$router = new Framework\Router;

$router->add("/", ["controller" => "home", "action" => "index"]);
$router->add("/products", ["controller" => "products", "action" => "index"]);
$router->add("/products/show", ["controller" => "products", "action" => "show"]);

$params = $router->matchRoute($path);

if ($params === false) {

    exit("No matching route");

}


$controller = "App\Controllers\\" . ucwords($params["controller"]);
$action = $params["action"];

$controller_object = new $controller;

$controller_object->$action();
?>