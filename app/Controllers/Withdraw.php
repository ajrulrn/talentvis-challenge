<?php

namespace App\Controllers;

use Core\Controller;
use Error;

class Withdraw extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Withdraw'
        ];
        return $this->view('withdraw', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Method not allowed');
        }

        try {
            $amount = $this->post('amount');

            if (!is_numeric($amount) && !is_int($amount)) {
                throw new Error('only number allowed');
            }

            $this->model('Transaction')->withdraw($amount);
        } catch (\Throwable $e) {
            $this->setFlashData('withdraw', $e->getMessage());
            return $this->redirect('/withdraw');
        }

        return $this->redirect('/');
    }
}
