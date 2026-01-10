<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;

$router = new Router();

// Load Routes
require_once __DIR__ . '/../routes/web.php';

// Dispatch
$router->dispatch();
