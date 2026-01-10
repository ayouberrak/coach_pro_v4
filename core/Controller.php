<?php
namespace Core;

class Controller {
    
    protected $twig;

    public function __construct() {

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../app/Views');
        
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false,  
            'debug' => true,   
        ]);
        $scriptName = $_SERVER['SCRIPT_NAME']; 
        $dir = dirname($scriptName);           
        $dir = str_replace('\\', '/', $dir);   
        if ($dir === '/') $dir = '';           
        $this->twig->addGlobal('base_url', $dir);
    }

    protected function render($view, $data = []) {
        echo $this->twig->render($view, $data);
    }
}
