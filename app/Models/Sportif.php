<?php
namespace App\Models;

class Sportif extends User {

    private int $id_sportif;
    private int $numero_telephone;

    public function __construct(int $id, string $firstName, string $lastName, string $email, string $passwordHash, int $role,
                                int $id_sportif, int $numero_telephone) {
        parent::__construct($id, $firstName, $lastName, $email, $passwordHash, $role);
        $this->id_sportif = $id_sportif;
        $this->numero_telephone = $numero_telephone;
    }
    public function getIdSportif(): int {
        return $this->id_sportif;
    }
    public function getNumeroTelephone(): int {
        return $this->numero_telephone;
    }
    public function setNumeroTelephone(int $numero_telephone): void {
        $this->numero_telephone = $numero_telephone;
    }

}
