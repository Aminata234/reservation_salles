<?php

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

try {
    Capsule::connection()->getPdo();

    echo "Connexion à la base de données réussie !" . PHP_EOL;
} catch (Throwable $e) {
    echo "Erreur de connexion : " . $e->getMessage() . PHP_EOL;
}


// APP_ENV=development
// APP_DEBUG=true

// DB_DRIVER=mysql
// DB_HOST=127.0.0.1 
// DB_PORT=3306
// DB_DATABASE=reservation_salles
// DB_USERNAME=root
// DB_PASSWORD=