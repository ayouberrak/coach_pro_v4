<?php
namespace App\Models;

class Disponabilite {
    private ?int $id_dispo;

    private int $id_coach;

    private string $date_dispo;
    private string $heure_debut;
    private string $heure_fin;

    public function __construct(?int $id_dispo = null, int $id_coach , string $date_dispo , string $heure_debut , string $heure_fin ) {
        $this->id_dispo = $id_dispo;
        $this->id_coach = $id_coach;
        $this->date_dispo = $date_dispo;
        $this->heure_debut = $heure_debut;
        $this->heure_fin = $heure_fin;
    }
    public function getIdDispo(): int {
        return $this->id_dispo;
    }
    public function getIdCoach(): int {
        return $this->id_coach;
    }
    public function getDateDispo(): string {
        return $this->date_dispo;
    }
    public function getHeureDebut(): string {
        return $this->heure_debut;
    }
    public function getHeureFin(): string {
        return $this->heure_fin;
    }
}