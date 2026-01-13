<?php


namespace App\Models;

class Avis{
    private ?int $id_avis;
    private int $id_coach;
    private int $id_client;
    private string $commentaire;
    private int $note;
    public function __construct(?int $id_avis = null, int $id_coach, int $id_client, string $commentaire, int $note){
        $this->id_avis = $id_avis;
        $this->id_coach = $id_coach;
        $this->id_client = $id_client;
        $this->commentaire = $commentaire;
        $this->note = $note;
    }

    public function getIdAvis(): ?int {
        return $this->id_avis;
    }
    public function getIdCoach(): int {
        return $this->id_coach;
    }
    public function getIdClient(): int {
        return $this->id_client;
    }
    public function getCommentaire(): string {
        return $this->commentaire;
    }
    public function getNote(): int {
        return $this->note;
    }

}