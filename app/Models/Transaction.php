<?php

namespace App\Models;

use Core\Database;
use Error;

class Transaction
{
    private $db;
    private $table = 'transactions';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTransactions()
    {
        $this->db->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        return $this->db->get();
    }

    public function deposit($amount)
    {
        try {
            $this->db->beginTransaction();
            $balance = $this->getBalance();
            $finalBalance = $amount + $balance;
    
            $data = [
                'category' => 'Deposit',
                'type' => 'Debit',
                'amount' => $amount,
                'balance' => $finalBalance
            ];
    
            $this->create($data);
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    public function withdraw($amount)
    {
        try {
            $this->db->beginTransaction();
            $balance = $this->getBalance();
            $finalBalance = $balance - $amount;
    
            if ($finalBalance < 0) {
                throw new Error('Your balance is insufficient');
            }
    
            $data = [
                'category' => 'Withdraw',
                'type' => 'Credit',
                'amount' => $amount,
                'balance' => $finalBalance
            ];

            $this->create($data);
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    public function getBalance()
    {
        $this->db->query("SELECT balance FROM {$this->table} ORDER BY created_at DESC");
        $result = $this->db->first();
        $balance = 0;

        if ($result) {
            $balance = $result->balance;
        }

        return $balance;
    }

    public function create($data)
    {
        $this->db->query("INSERT INTO {$this->table} (category, type, amount, balance) VALUES(:category, :type, :amount, :balance)");
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':balance', $data['balance']);
        return $this->db->execute();
    }
}
