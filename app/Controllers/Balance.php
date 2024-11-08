<?php

namespace App\Controllers;

use Core\Controller;

class Balance extends Controller
{
    private $transactionModel;

    public function __construct()
    {
        $this->transactionModel = $this->model('Transaction');
    }

    public function index()
    {
        $data = [
            'title' => 'Balance',
            'balance' =>  $this->transactionModel->getBalance()
        ];
        $this->view('balance', $data);
    }
}
