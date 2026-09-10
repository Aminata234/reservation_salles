<?php

namespace App\Controller;

use App\DTO\CreerSalleDTO;
use App\Repository\SalleRepositoryInterface;
use App\Service\CreerSalleService;
use App\Validation\SalleValidator;

final class SalleController
{
    public function __construct(
        private SalleRepositoryInterface $salleRepository,
        private SalleValidator $validator,
        private CreerSalleService $creerSalleService
    ) {}

    public function index(): void
    {
        $salles = $this->salleRepository->lister();

        require __DIR__ . '/../../templates/salle/index.php';
    }

    public function show(int $id): void
    {
        $salle = $this->salleRepository->trouver($id);

        if ($salle === null) {
            http_response_code(404);

            require __DIR__ . '/../../templates/error/404.php';

            return;
        }

        require __DIR__ . '/../../templates/salle/show.php';
    }

    public function create(): void
    {
        $errors = [];
        $data = [];

        require __DIR__ . '/../../templates/salle/form.php';
    }

    public function edit(int $id): void
    {
        $salle = $this->salleRepository->trouver($id);

        if ($salle === null) {
            http_response_code(404);

            require __DIR__ . '/../../templates/error/404.php';

            return;
        }

        $errors = [];

        $data = [
            'nom' => $salle->nom,
            'batiment' => $salle->batiment,
            'capacite' => $salle->capacite,
            'type' => $salle->type,
            'active' => $salle->active,
        ];

        require __DIR__ . '/../../templates/salle/form.php';
    }

    public function update(int $id): void
    {
        $salle = $this->salleRepository->trouver($id);

        if ($salle === null) {
            http_response_code(404);

            require __DIR__ . '/../../templates/error/404.php';

            return;
        }

        $data = [
            'nom' => trim($_POST['nom'] ?? ''),
            'batiment' => trim($_POST['batiment'] ?? ''),
            'capacite' => isset($_POST['capacite'])
                ? (int) $_POST['capacite']
                : 0,
            'type' => $_POST['type'] ?? '',
            'active' => isset($_POST['active']),
        ];

        $result = $this->validator->validate($data);

        if (!$result->isValid()) {
            $errors = $result->errors();

            require __DIR__ . '/../../templates/salle/form.php';

            return;
        }

        $salle->nom = $data['nom'];
        $salle->batiment = $data['batiment'];
        $salle->capacite = $data['capacite'];
        $salle->type = $data['type'];
        $salle->active = $data['active'];

        $this->salleRepository->enregistrer($salle);

        header('Location: /salles/' . $id);
        exit;
    }

    public function store(): void
    {
        $data = [
            'nom' => trim($_POST['nom'] ?? ''),
            'batiment' => trim($_POST['batiment'] ?? ''),
            'capacite' => isset($_POST['capacite'])
                ? (int) $_POST['capacite']
                : 0,
            'type' => $_POST['type'] ?? '',
            'active' => isset($_POST['active']),
        ];

        $result = $this->validator->validate($data);

        if (!$result->isValid()) {
            $errors = $result->errors();

            require __DIR__ . '/../../templates/salle/form.php';

            return;
        }

        $dto = new CreerSalleDTO(
            nom: $data['nom'],
            batiment: $data['batiment'],
            capacite: $data['capacite'],
            type: $data['type'],
            active: $data['active']
        );

        $this->creerSalleService->execute($dto);

        header('Location: /salles');
        exit;
    }
}
