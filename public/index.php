<?php

declare(strict_types=1);

use App\Application;
use DI\ContainerBuilder;
use FastRoute\Dispatcher;
use Illuminate\Database\Capsule\Manager;

require dirname(__DIR__) . '/vendor/autoload.php';

$builder = new ContainerBuilder();

$builder->addDefinitions(
    dirname(__DIR__) . '/config/container.php'
);

$container = $builder->build();

/*
 * Initialise Eloquent et sa connexion à la base de données.
 */
$container->get(Manager::class);

$dispatcher = $container->get(Dispatcher::class);

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

    case Dispatcher::NOT_FOUND:
        http_response_code(404);

        require dirname(__DIR__) . '/templates/error/404.php';

        break;

    case Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);

        header(
            'Allow: ' . implode(', ', $routeInfo[1])
        );

        require dirname(__DIR__) . '/templates/error/405.php';

        break;

    case Dispatcher::FOUND:

        $handler = $routeInfo[1];

        $vars = $routeInfo[2];

        $controllerClass = $handler[0];

        $method = $handler[1];

        $controller = $container->get($controllerClass);

        $controller->$method(...array_values($vars));

        break;
}