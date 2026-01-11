<?php

namespace Services;
use App\Models\User;
use Repository\UserRepository;
use Repository\CoachRepository;
use Repository\SportifRepository;
use Exception;

class AuthServices {

    private UserRepository $userRepository;
    private CoachRepository $coachRepository; 
    private SportifRepository $sportifRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
        $this->coachRepository = new CoachRepository();
        $this->sportifRepository = new SportifRepository();
    }

    public function registerUser(User $user): bool {
        try {
            $this->userRepository->createUser($user);
            if ($user->getRole() === 2) { 
                return $this->coachRepository->createCoach($user);
            } elseif ($user->getRole() === 3) { 
                return $this->sportifRepository->createSportif($user);
            }
            return true;
        } catch (Exception $e) {
            throw new Exception("Registration failed: " . $e->getMessage());
        }
    }
}