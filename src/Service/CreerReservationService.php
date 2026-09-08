<?php

namespace App\Service;

use App\DTO\CreerReservationDTO;
use App\Exception\SalleIndisponibleException;
use App\Model\Reservation;
use App\Repository\ReservationRepositoryInterface;
use App\Repository\SalleRepositoryInterface;
use DateTimeImmutable;

final class CreerReservationService
{
    public function __construct(
        private SalleRepositoryInterface $salleRepository,
        private ReservationRepositoryInterface $reservationRepository
    ) {
    }

    public function execute(CreerReservationDTO $dto): Reservation
    {
        $salle = $this->salleRepository->trouver($dto->salleId);

        if ($salle === null) {
            throw new SalleIndisponibleException(
                'La salle demandée n’existe pas.'
            );
        }

        if (!$salle->active) {
            throw new SalleIndisponibleException(
                'La salle n’est pas active.'
            );
        }

        if ($dto->dateDebut >= $dto->dateFin) {
            throw new \InvalidArgumentException(
                'La date de début doit précéder la date de fin.'
            );
        }

        $duree = $dto->dateDebut->diff($dto->dateFin);

        $dureeEnSecondes =
            ($duree->days * 86400)
            + ($duree->h * 3600)
            + ($duree->i * 60)
            + $duree->s;

        if ($dureeEnSecondes > 4 * 3600) {
            throw new \InvalidArgumentException(
                'La durée de réservation ne peut pas dépasser quatre heures.'
            );
        }

        $maintenant = new DateTimeImmutable();

        if ($dto->dateDebut <= $maintenant) {
            throw new \InvalidArgumentException(
                'La réservation doit être prévue dans le futur.'
            );
        }

        $conflit = $this->reservationRepository->rechercherConflit(
            $dto->salleId,
            $dto->dateDebut,
            $dto->dateFin
        );

        if ($conflit !== null) {
            throw new SalleIndisponibleException(
                'La salle est déjà réservée sur cette période.'
            );
        }

        $reservation = new Reservation();

        $reservation->salle_id = $dto->salleId;
        $reservation->responsable = $dto->responsable;
        $reservation->email = $dto->email;
        $reservation->motif = $dto->motif;
        $reservation->date_debut = $dto->dateDebut;
        $reservation->date_fin = $dto->dateFin;
        $reservation->statut = 'confirmée';

        return $this->reservationRepository->enregistrer(
            $reservation
        );
    }
}