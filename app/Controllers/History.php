<?php

namespace App\Controllers;

use Core\Controller;

class History extends Controller
{
    private $transactionModel;

    public function __construct()
    {
        $this->transactionModel = $this->model('Transaction');
    }

    public function index()
    {
        $data = [
            'title' => 'History',
            'transactions' => $this->transactionModel->getTransactions()
        ];

        $this->view('history', $data);
    }
}
