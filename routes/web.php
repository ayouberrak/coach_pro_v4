<?php

use Core\Router;

// Define routes here
// $router->get('/a/config', [Config\Database::class, 'showConfig']);


$router->get('/register', [App\Controllers\AuthController::class, 'showRegisterForm']);
$router->post('/register', [App\Controllers\AuthController::class, 'register']);


$router->get('/coach/profile', [App\Controllers\ProfileController::class, 'showProfile']);
$router->get('/', [App\Controllers\CoachController::class, 'index']);
$router->get('/coach/dashboard', [App\Controllers\CoachController::class, 'index']);
$router->get('/sportif/dashboard', [App\Controllers\SportifController::class, 'index']);
$router->get('/login', [App\Controllers\AuthController::class, 'login']);

