<?php
namespace App\Controllers;

use Core\Controller;

use App\Models\User;
use App\Models\Coach;
use App\Models\Sportif;

use App\Services\AuthServices;
use App\Services\RolesServices;


class AuthController extends Controller {
    
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
            // $file_name = pathinfo($_FILES['photo']['name'], PATHINFO_FILENAME);
            $file_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

            $new_file_name = 'image_' . time() . '.' . $file_extension;

            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/coachPro_v3/public/uploads/';


            $upload_path = $upload_dir . $new_file_name;

            move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path);
            
            $coachData = [
                'biographie' => $data['biographie'] ?? '',
                'photo' => $new_file_name,
                'anneeExperience' => $data['experience'] ?? 0,
                'certefications' => $data['certification'] ?? ''
            ];
        } elseif($role === 1){ 
            $sportifData = [
                'numero_telephone' => $data['telephone'] ?? ''
            ];
            
        }

        $authService = new AuthServices();

        try {
            $authService->registerUser($data, $coachData, $sportifData);
            if($role === 2){
                header("Location: ".BASE_URL."/coach/sport");
            } elseif($role === 1){
                header("Location: ".BASE_URL."/login");
            }
            exit();
        } catch (\Exception $e) {
            $this->render('auth/register.twig', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            echo "Registration failed: " . $e->getMessage();
        }
    }


    

    public function Login() {
        $authService = new AuthServices();

        try {
            if($_SERVER['REQUEST_METHOD'] !== 'POST'){
                $this->render('auth/login.twig');
                return;
            }
            $user = $authService->LoginUser($_POST['email'], $_POST['password']);
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_role'] = $user->getRole();

                if ($user->getRole() == 2) {
                    header("Location: ".BASE_URL."/coach/dashboard");
                } elseif ($user->getRole() == 1) {
                    header("Location: ".BASE_URL."/sportif/dashboard");
                } else {
                    header("Location: ".BASE_URL."/login");
                }
                exit();
            }else{
                echo "invalid";
            }
        } catch (\Exception $e) {
            $this->render('auth/login.twig', ['error' => 'error ' . $e->getMessage()]);
        }
    }
    public function logout() {
        session_start();
        session_destroy();
        header("Location: " . BASE_URL . "/login");
        exit();
    }


}
