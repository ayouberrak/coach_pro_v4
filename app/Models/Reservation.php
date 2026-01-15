<?php
namespace App\Models;

use DateTime;

class Reservation  {
    private ?int $idReservation;

    private int $idClient;
    private int $idCoach;

    private  $dateSeance;
    
    private  $debut;
    private int $duree;
    private int $id_status;

    public function __construct(?int $idReservation = null, int $idClient , int $idCoach,   $dateSeance , $debut, int $duree, int $id_status ) {
        $this->idReservation = $idReservation;
        $this->idClient = $idClient;
        $this->idCoach = $idCoach;
        $this->dateSeance = $dateSeance;
        $this->debut = $debut;
        $this->duree = $duree;
        $this->id_status = $id_status;
    }
    public function getIdReservation(): int {
        return $this->idReservation;
    }

    public function getDebut() {
        return $this->debut;
    }
    public function getIdClient(): int {
        return $this->idClient;
    }
    public function getIdCoach(): int {
        return $this->idCoach;
    }
    public function getDuree(): int {
        return $this->duree;
    }
    public function getIdStatus(): int {
        return $this->id_status;
    }
    public function getDateSeance() {
        return $this->dateSeance;
    }

    public static function arrayToReservation(array $data): Reservation {
        return new Reservation(
            $data['id_reservation'] ?? null,
            $data['id_client'],
            $data['id_coach'],
            $data['date_seance'],
            $data['debut'],
            $data['duree'],
            $data['id_status']
        );
    }
}
