<?php

namespace App\Services;
use App\Repository\DispoRepository;
use App\Models\Disponabilite;
use Exception;

class DispoServices {

    private DispoRepository $dispoRepository;

    public function __construct() {
        $this->dispoRepository = new DispoRepository();
    }

    public function getAllDispo($id_coach) {
        try {
            return $this->dispoRepository->getDispoByCoachId($id_coach);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve disponibilities: " . $e->getMessage());
        }
    }

    public function createDispo($data,$id): bool {
        try {
            $dispo = Disponabilite::arrayToDisponabilite($data , $id);
            return $this->dispoRepository->create($dispo);
        } catch (Exception $e) {
            throw new Exception("Failed to create disponibility: " . $e->getMessage());
        }
    }
}