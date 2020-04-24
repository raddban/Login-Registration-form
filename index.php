<?php

//session_start();
require_once __DIR__ . "/vendor/autoload.php";

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $router) {

    // UserController GET
    $router->addRoute('GET', '/', 'UserController@index');
    $router->addRoute('GET', '/confirm/{email}&{token}', 'UserController@confirm');
    $router->addRoute('GET', '/dashboard/{userEmail}', 'UserController@dashboard');
    $router->addRoute('GET', '/dashboard', 'UserController@dashboard');
    $router->addRoute('GET', '/dashboard/user/{logout}', 'UserController@userLogout');
    $router->addRoute('GET', '/login', 'UserController@dashboard');
    $router->addRoute('GET', '/register', 'UserController@registerPage');

    // User Controller POST
    $router->addRoute('POST', '/login', 'UserController@login');
    $router->addRoute('POST', '/register', 'UserController@registerUser');


    // EmailController GET
    $router->addRoute('GET', '/email', 'EmailController@emailPage');

    // EmailController POST
    $router->addRoute('POST', '/send/sendEmail', 'EmailController@send');

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = explode('@', $handler);

        $controllerPath = "\Mail\Controllers\\" . $controller;

        echo (new $controllerPath)->{$method}($vars);

        break;
}