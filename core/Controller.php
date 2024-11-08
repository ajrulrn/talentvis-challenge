<?php

namespace Core;

class Controller
{
    public function view($view, $data = [])
    {
        try {
            $view = new View($view, $data);
            return $view->render();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function model($model)
    {
        require_once BASE_PATH . '/app/Models/' . $model . '.php';
        $modelClass = 'App\\Models\\' . $model;
        return new $modelClass();
    }

    protected function isAuthenticated()
    {
        return isset($_SESSION['user']);
    }

    public function redirect($url)
    {
        $redirectUrl = APP_URL . $url;
        header('Location: ' . $redirectUrl);
    }

    public function setSession($name, $data)
    {
        $_SESSION[$name] = $data;
    }

    public function getSession($name)
    {
        return $_SESSION[$name] ?: null;
    }

    public function clearSession()
    {
        session_unset();
        session_destroy();
    }

    public function setFlashData($name, $message)
    {
        $this->setSession($name . '_flash', $message);
    }

    protected function get($key = null)
    {
        if ($key === null) {
            return $_GET;
        }
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }
    
    protected function post($key = null)
    {
        if ($key === null) {
            return $_POST;
        }
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }
}
