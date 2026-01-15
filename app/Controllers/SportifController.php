<?php
namespace App\Controllers;

use Core\Controller;
use App\Middleware\AuthMiddleware;
use App\Services\ReservationServices;

class SportifController extends Controller {
    public function index() {
        session_start();
        AuthMiddleware::handleSportif();
        $resServices = new ReservationServices();
        $total = $resServices->countResByClient($_SESSION['user_id']);
        $this->render('sportif/dashboard.twig', ['total' => $total]);
    }
}
