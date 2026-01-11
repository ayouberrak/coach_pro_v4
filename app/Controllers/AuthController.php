<?php
namespace App\Controllers;

use Core\Controller;

use App\Models\User;
use App\Models\Coach;
use App\Models\Sportif;

use App\Services\AuthServices;
use App\Services\RolesServices;


class AuthController extends Controller {
    
    public function login() {
        $this->render('auth/login.twig');
    }

    public function showRegisterForm() {
        $roleService = new RolesServices();
        $roles = $roleService->getAllRoles();
        $this->render('auth/register.twig', ['roles' => $roles]);
    }
    public function register($data) {
        $coachData = null;
        $sportifData = null;

        $role =  (int)$data['role'];

        if($role === 2){ 
            $coachData = [
                'biographie' => $data['biographie'] ?? '',
                'photo' => $data['photo'] ?? '',
                'annees_experience' => $data['annees_experience'] ?? 0,
                'certification' => $data['certification'] ?? ''
            ];
        } elseif($role === 1){ 
            $sportifData = [
                'numero_telephone' => $data['telephone'] ?? ''
            ];
            
        }

        $authService = new AuthServices();

        try {
            $authService->registerUser($data, $coachData, $sportifData);
            header("Location: ".BASE_URL."/login");
            exit();
        } catch (\Exception $e) {
            $this->render('auth/register.twig', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            echo "Registration failed: " . $e->getMessage();
        }
    }

}
