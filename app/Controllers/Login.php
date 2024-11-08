<?php

namespace App\Controllers;

use Core\Controller;

class Login extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        if ($this->isAuthenticated()) {
            return $this->redirect('/');
        }

        $data = [
            'title' => 'Login'
        ];
        $this->view('login', $data);
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Method not allowed');
        }

        $username = $this->post('username');
        $password = $this->post('password');

        $user = $this->userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user->password)) {
            unset($user->password);
            $this->setSession('user', $user);
            return $this->redirect('/');
        }

        $this->setFlashData('login', 'invalid username or password');
        return $this->redirect('/login');
    }
}
