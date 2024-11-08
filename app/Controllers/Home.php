<?php

namespace App\Controllers;

use Core\Controller;

class Home extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        $this->view('home', $data);
    }
}
