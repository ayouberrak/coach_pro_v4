<?php

namespace Repository;

use Config\Database;
use PDO;
use PDOException;
use Repository\UserRepository;
use App\Models\User;
use App\Models\Coach;




class CoachRepository {

    private PDO $db;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createCoach(Coach $coach): bool {
        try {
            $userId = (int)$this->db->lastInsertId();

            $stmt = $this->db->prepare("INSERT INTO coaches (id_coach, biographie, photo, annees_experience, certification) 
                                        VALUES (:id_coach, :biographie, :photo, :annees_experience, :certification)");
            $stmt->bindValue(':id_coach', $userId);
            $stmt->bindValue(':biographie', $coach->getBiographie());
            $stmt->bindValue(':photo', $coach->getPhoto());
            $stmt->bindValue(':annees_experience', $coach->getAnneeExperience());
            $stmt->bindValue(':certification', $coach->getCertefications());
           return  $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la création du coach: " . $e->getMessage());
        }
    }
}