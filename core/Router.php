<?php
namespace Core;

class Router {
    protected $routes = [];

    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Normalization for Windows
        $path = str_replace('\\', '/', $path);
        
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $scriptDir = dirname($scriptName);
        $scriptDir = str_replace('\\', '/', $scriptDir);

        // Logic to strip the base path
        // Case 1: Request URI starts with the full script path (e.g. /project/public/...)
        if (strpos($path, $scriptDir) === 0 && $scriptDir !== '/') {
            $path = substr($path, strlen($scriptDir));
        }
        // Case 2: Request URI starts with the parent of script path (hidden public via .htaccess)
        // e.g. Script: /project/public/index.php, Request: /project/dashboard
        elseif (strpos($path, dirname($scriptDir)) === 0 && dirname($scriptDir) !== '/') {
            $path = substr($path, strlen(dirname($scriptDir)));
        }

        // Ensure path starts with /
        if ($path === '' || $path[0] !== '/') {
            $path = '/' . $path;
        }

        // Debugging: echo "Path: $path"; exit;

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback) {
            if (is_array($callback)) {
                $controller = new $callback[0]();
                $method = $callback[1];
                return $controller->$method();
            }
            call_user_func($callback);
        } else {
            http_response_code(404);
            echo "<div style='font-family:monospace; background:#f8d7da; padding:20px; color:#721c24;'>";
            echo "<strong>404 Not Found</strong><br>";
            echo "The requested URL was not found on this server.<br><br>";
            echo "<strong>Debug Info:</strong><br>";
            echo "Method: $method<br>";
            echo "Raw URI: " . $_SERVER['REQUEST_URI'] . "<br>";
            echo "Calculated Path: $path<br>";
            echo "Script Dir: $scriptDir<br>";
            echo "Available Routes: <pre>" . print_r(array_keys($this->routes[$method] ?? []), true) . "</pre>";
            echo "</div>";
        }
    }
}
