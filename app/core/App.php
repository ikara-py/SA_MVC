<?php

namespace App\Core;

class App
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];
    public function __construct()
    {
        $url = $this->parseUrl();

        var_dump( $url);
        if(file_exists("../app/controllers/". $url[0] . ".php")){
            $this->controller = $url[0];
            unset($url[0]);
        }
        require_once "../app/controllers/" . $this->controller . ".php";
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
