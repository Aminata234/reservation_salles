<?php

namespace App\Repository;

use App\Model\Salle;

final class EloquentSalleRepository implements SalleRepositoryInterface
{
    public function lister(): array
    {
        return Salle::query()
            ->get()
            ->all();
    }

    public function trouver(int $id): ?Salle
    {
        return Salle::query()->find($id);
    }

    public function enregistrer(Salle $salle): Salle
    {
        $salle->save();

        return $salle;
    }
}