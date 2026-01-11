<?php

namespace Repository;

use App\Models\User;
use App\Models\Coach;
use App\Models\Sportif;
use Config\Database;
use PDO;
use PDOException;

class UserRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createUser(User $user): bool {
        try {
            $stmt = $this->db->prepare("INSERT INTO users (nom, prenom, email, password, id_role) 
                                        VALUES (:first_name, :last_name, :email, :password_hash, :role)");
            $stmt->bindValue(':first_name', $user->getFirstName());
            $stmt->bindValue(':last_name', $user->getLastName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password_hash', $user->getPasswordHash());
            $stmt->bindValue(':role', $user->getRole());
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la création de l'utilisateur: " . $e->getMessage());
        }
    }
    public function findUserByEmail(string $email): ?User {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new User(
                    (int)$row['id'],
                    $row['nom'],
                    $row['prenom'],
                    $row['email'],
                    $row['password'],
                    (int)$row['id_role']
                );
            }
            return null;
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la recherche de l'utilisateur: " . $e->getMessage());
        }
    }

    public function login(string $email, string $password): ?User {
        $user = $this->findUserByEmail($email);
        if ($user && password_verify($password, $user->getPasswordHash())) {
            return $user;
        }
        return null;
    }
}