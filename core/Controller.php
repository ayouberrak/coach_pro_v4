<?php
namespace Core;

class Controller {
    protected $twig;

    public function __construct() {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../app/Views');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false, // Set to 'cache' directory in production
            'debug' => true,
        ]);
    }

    protected function render($view, $data = []) {
        echo $this->twig->render($view, $data);
    }
}
