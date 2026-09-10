<?php

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/config/database.php';

use App\Repository\EloquentSalleRepository;
use App\Repository\EloquentReservationRepository;

echo "=== TEST DES REPOSITORIES ===" . PHP_EOL;

$salleRepository = new EloquentSalleRepository();

$salles = $salleRepository->lister();

echo "Nombre de salles : " . count($salles) . PHP_EOL;

foreach ($salles as $salle) {
    echo "- {$salle->nom} : {$salle->capacite} places" . PHP_EOL;
}

$salle = $salleRepository->trouver(1);

if ($salle !== null) {
    echo "Salle trouvée : {$salle->nom}" . PHP_EOL;
} else {
    echo "Salle introuvable." . PHP_EOL;
}

$reservationRepository = new EloquentReservationRepository();

$reservations = $reservationRepository->lister();

echo "Nombre de réservations : " . count($reservations) . PHP_EOL;

echo "=== TEST TERMINE ===" . PHP_EOL;