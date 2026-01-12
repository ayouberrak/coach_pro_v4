<?php


namespace App\Middleware;


class AuthMiddleware {
    public static function handleCoach() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 2) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
    }
    public static function handleSportif() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
    }
}