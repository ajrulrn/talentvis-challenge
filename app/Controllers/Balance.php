<?php

namespace App\Controllers;

use Core\Controller;

class Balance extends Controller
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
            'title' => 'Balance',
            'balance' =>  $this->transactionModel->getBalanceByUserId($this->getSession('user')->id)
        ];
        $this->view('balance', $data);
    }
}
