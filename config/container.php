<?php

use App\Application;
use App\Controller\ReservationController;
use App\Controller\SalleController;
use App\Repository\EloquentReservationRepository;
use App\Repository\EloquentSalleRepository;
use App\Repository\ReservationRepositoryInterface;
use App\Repository\SalleRepositoryInterface;
use App\Service\AnnulerReservationService;
use App\Service\CreerReservationService;
use App\Service\CreerSalleService;
use App\Validation\ReservationValidator;
use App\Validation\SalleValidator;
use Dotenv\Dotenv;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Illuminate\Database\Capsule\Manager;
use function DI\autowire;
use function DI\factory;
use function FastRoute\simpleDispatcher;

return [
    SalleRepositoryInterface::class =>
        autowire(EloquentSalleRepository::class),

    ReservationRepositoryInterface::class =>
        autowire(EloquentReservationRepository::class),

    SalleValidator::class =>
        autowire(),

    ReservationValidator::class =>
        autowire(),

    CreerReservationService::class =>
        autowire(),

    AnnulerReservationService::class =>
        autowire(),

    CreerSalleService::class =>
        autowire(),

    SalleController::class =>
        autowire(),

    ReservationController::class =>
        autowire(),

    Manager::class => factory(function (): Manager {

        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        $capsule = new Manager();

        $capsule->addConnection([
            'driver' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'database' => $_ENV['DB_DATABASE'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    }),

    Dispatcher::class => factory(function (): Dispatcher {

        $routes = require dirname(__DIR__) . '/routes/web.php';

        return simpleDispatcher(
            function (RouteCollector $router) use ($routes): void {
                $routes($router);
            }
        );
    }),

    Application::class =>
        autowire(),
];