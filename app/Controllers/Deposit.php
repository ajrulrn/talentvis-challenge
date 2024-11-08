<?php

namespace App\Controllers;

use Core\Controller;
use Error;

class Deposit extends Controller
{
    private $transactionModel;

    public function __construct()
    {
        if (!$this->isAuthenticated()) {
            return $this->redirect('/login');
        }

        $this->transactionModel = $this->model('Transaction');
    }

    public function index()
    {
        $data = [
            'title' => 'Deposit'
        ];
        $this->view('deposit', $data);
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

            $this->transactionModel->deposit($this->getSession('user')->id, $amount);
        } catch (\Throwable $e) {
            $this->setFlashData('deposit', $e->getMessage());
            return $this->redirect('/deposit');
        }

        return $this->redirect('/');
    }
}
