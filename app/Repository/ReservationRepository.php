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
            $stmt = $this->db->prepare("SELECT *   FROM seances s
                                                inner join users u on u.id = s.id_coach
                                                inner join coach c on c.id_coach = u.id
                                                inner join status st on st.id_status = s.id_status
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
                    'coachPhoto' =>  '/coachPro_v3/public/uploads/'.$data['photo'],
                    'status' => $data['type_status'],
                ];
            }
            return $info;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des réservations: " . $e->getMessage());
        }
    }

    public function UpdateStatusOnTerminer(){
        try {
            $stmt = $this->db->prepare("UPDATE seances 
                                        SET id_status = 4 
                                        WHERE (date_seance + debut + (duree || ' minutes')::interval) < NOW()
                                        AND id_status != 4");
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la mise à jour des statuts des réservations: " . $e->getMessage());
        }   
    }

    public function getReservationTerminerByClient(int $idClient): array {
        try {
            $stmt = $this->db->prepare("SELECT *   FROM seances s
                                                inner join users u on u.id = s.id_coach
                                                inner join coach c on c.id_coach = u.id
                                                inner join status st on st.id_status = s.id_status
                                                WHERE id_client = :id_client
                                                AND s.id_status = 4 ");

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
                    'status' => $data['type_status'],
                ];
            }
            return $info;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des réservations: " . $e->getMessage());
        }

    }

    public function countResByClient(int $idClient): int {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM seances WHERE id_client = :id_client");
            $stmt->bindValue(':id_client', $idClient, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int)$result['total'];
        } catch (Exception $e) {
            throw new Exception("Erreur lors du comptage des réservations: " . $e->getMessage());
        }
    }


    public function getReservationEnattenteByIdCoach(int $idCoach): array {
        try {
            $stmt = $this->db->prepare("SELECT *   FROM seances s
                                                inner join users u on u.id = s.id_client
                                                inner join client cl on cl.id_client = u.id
                                                inner join status st on st.id_status = s.id_status
                                                WHERE id_coach = :id_coach
                                                AND s.id_status = 3 ");

            $stmt->bindValue(':id_coach', $idCoach, PDO::PARAM_INT);
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
                    'nomClient' => $data['prenom'] . ' ' . $data['nom'],
                ];
            }
            return $info;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des réservations: " . $e->getMessage());
        }
    }


    public function changeStatusReservation($idReservation, $newStatus): bool {
        try {
            $stmt = $this->db->prepare("UPDATE seances SET id_status = :new_status WHERE id_seance = :id_reservation");
            $stmt->bindValue(':new_status', $newStatus, PDO::PARAM_INT);
            $stmt->bindValue(':id_reservation', $idReservation, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la mise à jour du statut de la réservation: " . $e->getMessage());
        }
    }


    public function getReservationByCoachId(int $idCoach): array {
        try {
            $stmt = $this->db->prepare("SELECT * FROM seances s inner join users u on u.id = s.id_client WHERE s.id_coach = :id_coach");
            $stmt->bindValue(':id_coach', $idCoach, PDO::PARAM_INT);
            $stmt->execute();
            $reservationsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $reservations = [];
            foreach ($reservationsData as $data) {
                $reservations[] = [
                    'reservation' => new Reservation(
                        $data['id_seance'],
                        $data['id_client'],
                        $data['id_coach'],
                        $data['date_seance'],
                        $data['debut'],
                        $data['duree'],
                        $data['id_status']
                    ),
                    'nomClient' => $data['prenom'] . ' ' . $data['nom'],
                ];
            }
            return $reservations;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des réservations: " . $e->getMessage());
        }
    }   


}