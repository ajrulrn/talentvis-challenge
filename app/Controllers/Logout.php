<?php

namespace App\Controllers;

use Core\Controller;

class Logout extends Controller
{
    public function index()
    {
        $this->clearSession();
        return $this->redirect('/login');
    }
}
