<?php
namespace App\Controllers;

use Core\Controller;
use \App\Services\ReservationServices;
use \App\Middleware\AuthMiddleware;

class ReservationController extends Controller {
    public function index() {
        session_start();
        AuthMiddleware::handleCoach();
         $user_role = $_SESSION['user_role'] ;

        $this->render('coach/reservations.twig', ['user_role' => $user_role]);
    }


    public function acceptReservation($id) {
        session_start();
        AuthMiddleware::handleCoach();
        $resService = new ReservationServices();
        $resService->changeStatusReservation($id, 1);
        header("Location: ".BASE_URL."/coach/dashboard");
        exit();
    }

    public function declineReservation($id) {
        session_start();
        AuthMiddleware::handleCoach();
        $resService = new ReservationServices();
        $resService->changeStatusReservation($id, 2);
        header("Location: ".BASE_URL."/coach/dashboard");
        exit();
        
    }

    
}
