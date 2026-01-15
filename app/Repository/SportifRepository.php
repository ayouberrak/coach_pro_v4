<?php

namespace App\Repository;

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

            $stmt = $this->db->prepare("INSERT INTO client (id_client, telephone) 
                                        VALUES (:id_client, :telephone)");
            $stmt->bindValue(':id_client', $userId);
            $stmt->bindValue(':telephone', $sportif->getNumeroTelephone());
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la création du sportif: " . $e->getMessage());
        }
    }

    public function getInfoClientById(int $id_client) {
        $stmt = $this->db->prepare("SELECT * FROM users u inner join client c on c.id_client = u.id WHERE u.id = :id_client");
        $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return Sportif::createFromArray($data);
        }
    }
}