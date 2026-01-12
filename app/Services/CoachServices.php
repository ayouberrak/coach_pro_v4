<?php

namespace App\Services;

use App\Repository\CoachRepository;
use Exception;
class CoachServices {

    private CoachRepository $coachRepository;

    public function __construct() {
        $this->coachRepository = new CoachRepository();
    }

    public function getAllCoach() {
        try {
            return $this->coachRepository->GetAllCoaches();
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve coach: " . $e->getMessage());
        }
    }
}