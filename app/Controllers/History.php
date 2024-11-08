<?php

namespace App\Controllers;

use Core\Controller;

class History extends Controller
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
            'title' => 'History',
            'transactions' => $this->transactionModel->getTransactionsByUserId($this->getSession('user')->id)
        ];

        $this->view('history', $data);
    }
}
