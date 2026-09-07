<?php

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/config/database.php';

use App\Model\Salle;
use App\Model\Reservation;

echo "=== TEST DES MODELES ELOQUENT ===" . PHP_EOL;

// Test Salle
$salles = Salle::all();

echo "Nombre de salles : " . $salles->count() . PHP_EOL;

// Test Reservation
$reservations = Reservation::all();

echo "Nombre de réservations : " . $reservations->count() . PHP_EOL;

// Test relation Salle -> Reservations
if ($salles->isNotEmpty()) {
    $salle = $salles->first();

    echo "Salle testée : " . $salle->nom . PHP_EOL;
    echo "Nombre de réservations de cette salle : "
        . $salle->reservations->count()
        . PHP_EOL;
}

// Test relation Reservation -> Salle
if ($reservations->isNotEmpty()) {
    $reservation = $reservations->first();

    echo "Responsable : " . $reservation->responsable . PHP_EOL;
    echo "Salle de la réservation : "
        . $reservation->salle->nom
        . PHP_EOL;
}

echo "=== TEST TERMINE ===" . PHP_EOL;