<?php

namespace App\Controllers;
use Core\Controller;

class DispoController extends Controller {
    public function index() {
        session_start();
        \App\Middleware\AuthMiddleware::handleCoach();
         $user_role = $_SESSION['user_role'] ;

        $this->render('coach/disponibilities.twig', ['user_role' => $user_role]);
    }

}