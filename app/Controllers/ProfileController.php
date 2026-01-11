<?php 

namespace App\Controllers;
use Core\Controller;

class ProfileController extends Controller {
    public function showProfile() {
        $data = [
            'username' => 'JohnDoe',
            'email' => 'john.doe@example.com'
        ];
        $this->render('coach/profile.twig', $data);
    }
}