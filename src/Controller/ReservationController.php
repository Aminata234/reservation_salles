<?php

namespace App\Controller;

use App\Service\AnnulerReservationService;
use App\DTO\CreerReservationDTO;
use App\Repository\ReservationRepositoryInterface;
use App\Repository\SalleRepositoryInterface;
use App\Service\CreerReservationService;
use App\Validation\ReservationValidator;
use DateTimeImmutable;

final class ReservationController
{
    public function __construct(
        private ReservationRepositoryInterface $reservationRepository,
        private SalleRepositoryInterface $salleRepository,
        private ReservationValidator $validator,
        private CreerReservationService $creerReservationService,
        private AnnulerReservationService $annulerReservationService
    ) {}

    public function index(): void
    {
        $reservations = $this->reservationRepository->lister();

        require __DIR__ . '/../../templates/reservation/index.php';
    }

    public function show(int $id): void
    {
        $reservation = $this->reservationRepository->trouver($id);

        if ($reservation === null) {
            http_response_code(404);

            require __DIR__ . '/../../templates/error/404.php';

            return;
        }

        require __DIR__ . '/../../templates/reservation/show.php';
    }

    public function create(): void
    {
        $salles = $this->salleRepository->lister();

        $errors = [];
        $data = [];

        require __DIR__ . '/../../templates/reservation/form.php';
    }

    public function store(): void
    {
        $data = [
            'salle_id' => isset($_POST['salle_id'])
                ? (int) $_POST['salle_id']
                : 0,

            'responsable' => trim($_POST['responsable'] ?? ''),

            'email' => trim($_POST['email'] ?? ''),

            'motif' => trim($_POST['motif'] ?? ''),

            'date_debut' => $_POST['date_debut'] ?? '',

            'date_fin' => $_POST['date_fin'] ?? '',
        ];

        $result = $this->validator->validate($data);

        if (!$result->isValid()) {
            $errors = $result->errors();

            $salles = $this->salleRepository->lister();

            require __DIR__ . '/../../templates/reservation/form.php';

            return;
        }

        $dateDebut = new DateTimeImmutable($data['date_debut']);
        $dateFin = new DateTimeImmutable($data['date_fin']);

        $dto = new CreerReservationDTO(
            salleId: $data['salle_id'],
            responsable: $data['responsable'],
            email: $data['email'],
            motif: $data['motif'],
            dateDebut: $dateDebut,
            dateFin: $dateFin
        );

        $this->creerReservationService->execute($dto);

        header('Location: /reservations');
        exit;
    }

    public function cancel(int $id): void
    {
        $this->annulerReservationService->execute($id);

        header('Location: /reservations');
        exit;
    }
}
