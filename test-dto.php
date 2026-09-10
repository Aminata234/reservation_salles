<?php

require __DIR__ . '/vendor/autoload.php';

use App\DTO\CreerSalleDTO;
use App\DTO\CreerReservationDTO;

$salle = new CreerSalleDTO(
    'Salle B12',
    'Bâtiment B',
    40,
    'cours',
    true
);

$reservation = new CreerReservationDTO(
    2,
    'Aminata',
    'aminata@example.com',
    'Cours de PHP',
    new DateTimeImmutable('2026-09-10 10:00:00'),
    new DateTimeImmutable('2026-09-10 12:00:00')
);

var_dump($salle);
var_dump($reservation);