<?php

namespace App\Controllers;

use Core\Controller;

class Home extends Controller
{
    public function __construct()
    {
        if (!$this->isAuthenticated()) {
            return $this->redirect('/login');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        $this->view('home', $data);
    }
}
