<?php
namespace App\Models;

use DateTime;

class Reservation {
    private ?int $idReservation;
    private int $idClient;

    private int $idCoach;
    private DateTime $debut;
    private int $duree;
    private int $id_status;

    public function __construct(?int $idReservation = null, int $idClient , int $idCoach, DateTime $debut, int $duree, int $id_status ) {
        $this->idReservation = $idReservation;
        $this->idClient = $idClient;
        $this->idCoach = $idCoach;
        $this->debut = $debut;
        $this->duree = $duree;
        $this->id_status = $id_status;
    }
    public function getIdReservation(): int {
        return $this->idReservation;
    }
    public function getIdClient(): int {
        return $this->idClient;
    }
    public function getIdCoach(): int {
        return $this->idCoach;
    }
    public function getDebut(): DateTime {
        return $this->debut;
    }
    public function getDuree(): int {
        return $this->duree;
    }
    public function getIdStatus(): int {
        return $this->id_status;
    }
}
