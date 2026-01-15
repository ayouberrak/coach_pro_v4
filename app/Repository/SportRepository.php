<?php

namespace App\Repository;
use Config\Database;
use App\Models\Sport;
use PDO;

class SportRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getSportsByIdCoach(int $id_coach): ?array {
        $stmt = $this->db->prepare("SELECT s.id_sport, s.type, s.description 
                                FROM sport s
                                JOIN sport_coach sp ON s.id_sport = sp.id_sport
                                WHERE sp.id_coach = :id_coach");
        $stmt->bindParam(':id_coach', $id_coach, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sports = [];
        foreach ($rows as $row) {
            $sports[] = new Sport(
                $row['id_sport'],
                $row['type'],
                $row['description']
            );
        }
        return $sports;
    }


}