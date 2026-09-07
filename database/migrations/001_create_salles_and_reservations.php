<?php

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

require dirname(__DIR__, 2) . '/config/database.php';

$schema = Capsule::schema();

if (!$schema->hasTable('salles')) {
    $schema->create('salles', function ($table) {
        $table->id();
        $table->string('nom', 100);
        $table->string('batiment', 100);
        $table->unsignedInteger('capacite');
        $table->enum('type', [
            'cours',
            'informatique',
            'laboratoire',
            'amphitheatre',
            'reunion'
        ]);
        $table->boolean('active')->default(true);
        $table->timestamps();
    });
}

if (!$schema->hasTable('reservations')) {
    $schema->create('reservations', function ($table) {
        $table->id();

        $table->foreignId('salle_id')
            ->constrained('salles')
            ->restrictOnDelete();

        $table->string('responsable', 120);
        $table->string('email', 255);
        $table->string('motif', 255);
        $table->dateTime('date_debut');
        $table->dateTime('date_fin');

        $table->enum('statut', [
            'confirmée',
            'annulée'
        ])->default('confirmée');

        $table->timestamps();

        $table->index([
            'salle_id',
            'date_debut',
            'date_fin',
            'statut'
        ]);
    });
}

echo "Tables créées avec succès." . PHP_EOL;