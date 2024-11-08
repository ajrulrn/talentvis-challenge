<?php

namespace Core;

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        if (file_exists(BASE_PATH . '/app/Controllers/' . ucfirst($url[0] . '.php'))) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        require_once BASE_PATH . '/app/Controllers/' . $this->controller . '.php';
        $controllerClass = 'App\\Controllers\\' . $this->controller;
        $this->controller = new $controllerClass;

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        $request = $_SERVER['REQUEST_URI'];

        if (isset($request)) {
            $url = rtrim(ltrim($request, '/'), '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }

        return ['home'];
    }
}
