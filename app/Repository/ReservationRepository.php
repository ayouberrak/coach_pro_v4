<?php

namespace App\Repository;

use Config\Database;
use PDO;
use App\Models\Reservation;
use Exception;

class ReservationRepository {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createReservation(Reservation $reservation): bool {
        try {
            $stmt = $this->db->prepare("INSERT INTO seances ( debut, duree , id_client , id_coach, id_status ,date_seance) VALUES (:debut, :duree, :id_client, :id_coach, :id_status, :date_seance)");
            $stmt->bindValue(':debut', $reservation->getDebut(), PDO::PARAM_STR);
            $stmt->bindValue(':duree', $reservation->getDuree(), PDO::PARAM_INT);
            $stmt->bindValue(':id_client', $reservation->getIdClient(), PDO::PARAM_INT);
            $stmt->bindValue(':id_coach', $reservation->getIdCoach(), PDO::PARAM_INT);
            $stmt->bindValue(':id_status', $reservation->getIdStatus(), PDO::PARAM_INT);
            $stmt->bindValue(':date_seance', $reservation->getDateSeance(), PDO::PARAM_STR);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la création de la réservation: " . $e->getMessage());
        }
    }

    public function getReservationsEnAttenteByIdClient(int $idClient): array {
        try {
            $stmt = $this->db->prepare("SELECT * FROM seances s
                                                inner join users u on u.id = s.id_coach
                                                inner join coach c on c.id_coach = u.id
                                                WHERE id_client = :id_client
                                                AND s.id_status != 4 ");

            $stmt->bindValue(':id_client', $idClient, PDO::PARAM_INT);
            $stmt->execute();
            $reservationsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $info = [];
            foreach ($reservationsData as $data) {
                $info[] = [
                    'reservation' => new Reservation(
                        $data['id_seance'],
                        $data['id_client'],
                        $data['id_coach'],
                        $data['date_seance'],
                        $data['debut'],
                        $data['duree'],
                        $data['id_status']
                    ),
                    'nomCoach' => $data['prenom'] . ' ' . $data['nom'],
                    'coachPhoto' => $data['photo']
                ];
            }
            return $info;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des réservations: " . $e->getMessage());
        }
    }


}