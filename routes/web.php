<?php

use Core\Router;

// Define routes here
// $router->get('/a/config', [Config\Database::class, 'showConfig']);
$router->get('/', [App\Controllers\CoachController::class, 'index']); // Temporary: make home the coach dashboard for ease of access
$router->get('/coach/dashboard', [App\Controllers\CoachController::class, 'index']);
$router->get('/sportif/dashboard', [App\Controllers\SportifController::class, 'index']);
$router->get('/login', [App\Controllers\AuthController::class, 'login']);

