<?php

namespace App\Controllers;

use Core\Controller;
use App\Services\CoachServices;
use App\Services\DispoServices;
use App\Services\SportServices;
use App\Services\ReservationServices;
use Exception;
class DetailsCoachController extends Controller {

        public function showCoaches($id) {
            $coachServices = new CoachServices();
            $coach = $coachServices->getCoachById($id);

            $dispoServices = new DispoServices();
            $disponibilities = $dispoServices->getAllDispo($id);
            $disopFroma = [];
            foreach ($disponibilities as $dispo) {
                $disopFroma[] = [
                    'date' => $dispo->getDateDispo(),
                    'heure' => date('H:i', strtotime($dispo->getHeureDebut())),
                ];
            }

            $sportServices = new SportServices();
            $sport = $sportServices->getSportByIdCoach($id);
            

            
            $this->render('sportif/detailsCoach.twig', [
                'coach' => $coach ,
                'disopFroma' => $disopFroma,
                'sport' => $sport
            ]);
    }

    public function createReservation($request, $id) {
        session_start();
        \App\Middleware\AuthMiddleware::handleSportif();
        $user_role = $_SESSION['user_role'] ;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_sportif = $_SESSION['user_id'];
            $id_coach = (int) $id;
            $heure_debut = $request['heure'];
            $date_reservation = $request['date'];
            $duree = $request['duree'];

            $reservationServices = new ReservationServices();
            try {
                $reservationServices->createReservation([
                    'id_client' => $id_sportif,
                    'date_seance' => $date_reservation ,
                    'debut' => $heure_debut,
                    'duree' => $duree, 
                    'id_status' => 3
                ], $id_coach);
                
                header('Location: '.BASE_URL.'/sportif/coach/details/'.$id_coach);
                exit();
            } catch (Exception $e) {
                echo "Error creating reservation: " . $e->getMessage();
            }
        }
       
    }
}