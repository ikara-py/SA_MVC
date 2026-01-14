<?php

namespace App\Core;
use App\Controllers\Home;

class App
{
    protected $controller = 'App\Controllers\Home';
    protected $method = 'index';
    protected $params = [];
    public function __construct()
    {
        // var_dump($_GET['url']);
        $url = $this->parseUrl() ?? ['Home'];

        // var_dump( $url);
        if(file_exists("../app/controllers/{$url[0]}.php")){
            $this->controller = 'App\Controllers\\' . $url[0];
            unset($url[0]);
        }
        require_once "../app/controllers/" . basename(str_replace('\\', '/', $this->controller)) . ".php";
        $this->controller = new $this->controller;
        // var_dump($this->controller);
        // echo gettype($this->controller);

        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
                // echo'does exist ???';
            }
        }
        $this->params = $url ? array_values($url) : [];
        // var_dump($this->params);
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}

