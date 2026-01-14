<?php

namespace App\Repository;

use Config\Database;
use PDO;
use Exception;

class DispoRepository {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getDispoByCoachId(int $coachId): array {
        try {
            $stmt = $this->db->prepare("SELECT * FROM disponible WHERE id_coach = :id_coach");
            $stmt->bindValue(':id_coach', $coachId, PDO::PARAM_INT);
            $stmt->execute();
            $disposData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $dispos = [];
            foreach ($disposData as $data) {
                $dispos[] = new \App\Models\Disponabilite(
                    $data['id_dispo'],
                    $data['id_coach'],
                    $data['jour'],
                    $data['heures_debut'],
                    $data['heures_fin']
                );
            }
            return $dispos;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des disponibilités: " . $e->getMessage());
        }
    }

}