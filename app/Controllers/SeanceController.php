<?php
namespace App\Controllers;

use \App\Middleware\AuthMiddleware;
use Core\Controller;
use App\Services\ReservationServices;

class SeanceController extends Controller {
    public function index() {
        session_start();
        // echo $_SESSION['user_id'];/
        $user_role = $_SESSION['user_role'] ;
        AuthMiddleware::handleSportif();

        $resServices = new ReservationServices();
        $resServices->UpdateStatusOnTerminer();
        $resEnatt = $resServices->getReservationsByClientId($_SESSION['user_id']);


        $resTerminer = $resServices->getReservationTerminerByClient($_SESSION['user_id']);

        // print_r($resServices);


        $this->render('sportif/seances.twig', [
                'user_role' => $user_role ,
                'reservation' => $resEnatt,
                'resTerminer' => $resTerminer
            ]);
    }
}
