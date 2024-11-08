<?php

namespace App\Controllers;

use Core\Controller;
use Error;

class Transfer extends Controller
{
    private $userModel;
    private $transactionModel;

    public function __construct()
    {
        if (!$this->isAuthenticated()) {
            return $this->redirect('/login');
        }

        $this->userModel = $this->model('User');
        $this->transactionModel = $this->model('Transaction');
    }

    public function index()
    {
        $data = [
            'title' => 'Transfer',
            'recipients' => $this->userModel->getRecipients($this->getSession('user')->id)
        ];
        $this->view('transfer', $data);
    }
    
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Method not allowed');
        }

        $recipientId = $this->post('recipient');
        $recipient = $this->userModel->getUserById($recipientId);
        
        try {
            $amount = $this->post('amount');
            
            if (!is_numeric($amount) && !is_int($amount)) {
                throw new Error('only number allowed');
            }

            $this->transactionModel->transfer($amount, $this->getSession('user'), $recipient);
        } catch (\Throwable $e) {
            $this->setFlashData('transfer', $e->getMessage());
            return $this->redirect('/transfer');
        }

        return $this->redirect('/');
    }
}
