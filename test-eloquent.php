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


