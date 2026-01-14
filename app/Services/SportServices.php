<?php

namespace App\Services;

use App\Repository\SportRepository;
use Exception;

class SportServices {

    private SportRepository $sportRepository;

    public function __construct() {
        $this->sportRepository = new SportRepository();
    }

    public function getSportByIdCoach($id_coach) {
        try {
            return $this->sportRepository->getSportsByIdCoach($id_coach);
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve sports: " . $e->getMessage());
        }
    }
}