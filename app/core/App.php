<?php

namespace App\Core;

class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // Controller
        if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        // Include file controller
        require_once '../app/controllers/' . $this->controller . '.php';

        // Tambahkan namespace ke class controller
        $this->controller = "App\\Controllers\\" . $this->controller;

        // Buat instance controller
        $this->controller = new $this->controller;

        // Method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Parameters
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
    // protected function parseUrl()
    // {
    //     if (isset($_GET['url'])) {
    //         return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
    //     }
    // }
    // public function __construct()
    // {
    //     $this->init();
    // }

    // public function init()
    // {
    //     $this->loadConfig();
    //     $this->loadHelpers();
    //     $this->loadDatabase();
    //     $this->loadRoutes();
    // }

    // public function loadConfig()
    // {
    //     require_once __DIR__ . '/../config/config.php';
    // }

    // public function loadHelpers()
    // {
    //     require_once __DIR__ . '/../helpers/helpers.php';
    // }

    // public function loadDatabase()
    // {
    //     require_once __DIR__ . '/../core/Database.php';
    //     $this->db = new Database();
    // }

    // public function loadRoutes()
    // {
    //     require_once __DIR__ . '/../routes/web.php';
    // }
}
