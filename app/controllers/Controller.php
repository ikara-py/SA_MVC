<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    protected $twig;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $loader = new FilesystemLoader(__DIR__ . '/../views');        
        $this->twig = new Environment($loader, [
            // 'cache' => __DIR__ . '/../storage/cache',
            'debug' => true,
        ]);
        $this->twig->addGlobal('session', $_SESSION);
    }

    public function view($view, $data = []): void
    {
        if (file_exists("../app/views/{$view}.twig")) {
            echo $this->twig->render("{$view}.twig", $data);
        } else {
            if (file_exists('../app/views/errors/404.php')) {
                require_once '../app/views/errors/404.php';
            } else {
                die("404 page is missing.");
            }
        }
    }
}