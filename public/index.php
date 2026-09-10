<?php

require_once __DIR__ . '/../vendor/autoload.php';

$routes = require __DIR__ . '/../routes/web.php';

$dispatcher = FastRoute\simpleDispatcher(
    function (FastRoute\RouteCollector $router) use ($routes): void {
        $routes($router);
    }
);

$httpMethod = $_SERVER['REQUEST_METHOD'];

$uri = parse_url(
    $_SERVER['REQUEST_URI'],
    PHP_URL_PATH
);

$routeInfo = $dispatcher->dispatch(
    $httpMethod,
    $uri
);

switch ($routeInfo[0]) {

    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);

        require __DIR__ . '/../templates/error/404.php';

        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);

        header(
            'Allow: ' . implode(', ', $routeInfo[1])
        );

        require __DIR__ . '/../templates/error/405.php';

        break;

    case FastRoute\Dispatcher::FOUND:

        $handler = $routeInfo[1];

        $vars = $routeInfo[2];

        break;
}