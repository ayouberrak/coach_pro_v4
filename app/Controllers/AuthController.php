<?php
namespace App\Controllers;

use Core\Controller;

class AuthController extends Controller {
    
    public function login() {
        $this->render('auth/login.twig');
    }

    public function handleLogin() {
        // Mock login logic
        echo "Login processing...";
    }
}
