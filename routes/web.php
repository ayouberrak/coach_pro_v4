<?php

use Core\Router;

// Define routes here
// $router->get('/a/config', [Config\Database::class, 'showConfig']);
$router->get('/', [App\Controllers\CoachController::class, 'index']);


$router->get('/register', [App\Controllers\AuthController::class, 'showRegisterForm']);
$router->post('/register', [App\Controllers\AuthController::class, 'register']);

$router->post('/login', [App\Controllers\AuthController::class, 'Login']);

$router->get('/logout', [App\Controllers\AuthController::class, 'logout']);

$router->get('/coach/profile', [App\Controllers\ProfileController::class, 'showProfile']);

$router->get('/coach/reservations', [App\Controllers\ReservationController::class, 'index']);

$router->get('/coach/disponibilities', [App\Controllers\DispoController::class, 'index']);

$router->get('/coach/dashboard', [App\Controllers\CoachController::class, 'dashboard']);

$router->get('/coach/dashboard/accept/{id}', [App\Controllers\ReservationController::class, 'acceptReservation']);
$router->get('/coach/dashboard/refuse/{id}', [App\Controllers\ReservationController::class, 'declineReservation']);

$router->post('/coach/disponibilities', [App\Controllers\DispoController::class, 'create']);


$router->get('/sportif/dashboard', [App\Controllers\SportifController::class, 'index']);
$router->get('/sportif/coaches', [App\Controllers\CoachsController::class, 'index']);
$router->get('/sportif/seances', [App\Controllers\SeanceController::class, 'index']);

$router->get('/sportif/profile', [App\Controllers\ProfileSportifController::class, 'showProfile']);
$router->post('/sportif/profile', [App\Controllers\ProfileSportifController::class, 'editProfile']);

$router->get('/sportif/coach/details/{id}', [App\Controllers\DetailsCoachController::class, 'showCoaches']);
$router->post('/sportif/coach/details/{id}', [App\Controllers\DetailsCoachController::class, 'createReservation']);

$router->get('/login', [App\Controllers\AuthController::class, 'login']);



