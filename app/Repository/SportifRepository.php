<?php

namespace Repository;

use Repository\UserRepository;
use App\Models\User;
use App\Models\Sportif;
use Config\Database;
use PDO;
use PDOException;

class SportifRepository {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createSportif(Sportif $sportif): bool {
        try {
            $userId = (int)$this->db->lastInsertId();

            $stmt = $this->db->prepare("INSERT INTO sportifs (id_client, telephone) 
                                        VALUES (:id_client, :telephone)");
            $stmt->bindValue(':id_client', $userId);
            $stmt->bindValue(':telephone', $sportif->getNumeroTelephone());
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la création du sportif: " . $e->getMessage());
        }
    }
}