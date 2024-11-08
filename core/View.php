<?php

namespace Core;

class View
{
    protected $data = [];
    protected $view;

    public function __construct($view, $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function render()
    {
        if (is_array($this->data)) {
            extract($this->data);
        }

        $viewPath = BASE_PATH . '/app/Views/' . $this->view . '.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            throw new \Exception('View' . $this->view . ' not found');
        }
    }

    public function include($view)
    {
        if (is_array($this->data)) {
            extract($this->data);
        }
        
        $viewPath = BASE_PATH . '/app/Views/' . $view . '.php';
        include($viewPath);
    }

    public function getSession($name)
    {
        return $_SESSION[$name] ?: null;
    }

    public function getFlashData($name)
    {
        $flashName = $name . '_flash';
        if (isset($_SESSION[$flashName])) {
            $message = $_SESSION[$flashName];
            unset($_SESSION[$flashName]);
            return $message;
        }
        return null;
    }
}
