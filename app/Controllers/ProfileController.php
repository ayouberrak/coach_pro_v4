<?php 

namespace App\Controllers;
use Core\Controller;
use \App\Middleware\AuthMiddleware;


class ProfileController extends Controller {
    public function showProfile() {
        session_start();
        $user_role = $_SESSION['user_role'] ;

        AuthMiddleware::handleCoach();
        $this->render('coach/profile.twig', ['user_role' => $user_role]);
    }
}