<?php
namespace App\Models;

class Coach extends User {
    private int $id_coach;

    private string $biographie;
    private string $photo;
    private int $annee_experience;
    private string $certefications;

    

    public function __construct(int $id, string $firstName, string $lastName, string $email, string $passwordHash, int $role,
                                int $id_coach, string $biographie, string $photo, int $annee_experience, string $certefications) {
        parent::__construct($id, $firstName, $lastName, $email, $passwordHash, $role);
        $this->id_coach = $id_coach;
        $this->biographie = $biographie;
        $this->photo = $photo;
        $this->annee_experience = $annee_experience;
        $this->certefications = $certefications;
    }
    public function getIdCoach(): int {
        return $this->id_coach;
    }
    public function getBiographie(): string {
        return $this->biographie;
    }
    public function getPhoto(): string {
        return $this->photo;
    }
    public function getAnneeExperience(): int {
        return $this->annee_experience;
    }
    public function getCertefications(): string {
        return $this->certefications;
    }
    public function setBiographie(string $biographie): void {
        $this->biographie = $biographie;
    }
    public function setPhoto(string $photo): void {
        $this->photo = $photo;
    }
    public function setAnneeExperience(int $annee_experience): void {
        $this->annee_experience = $annee_experience;
    }
    public function setCertefications(string $certefications): void {
        $this->certefications = $certefications;
    }
}
