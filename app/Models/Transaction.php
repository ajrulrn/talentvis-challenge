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

    public function getTransactionsByUserId($userId)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE user_id = :userId ORDER BY created_at DESC");
        $this->db->bind(':userId', $userId);
        return $this->db->get();
    }

    public function deposit($userId, $amount)
    {
        try {
            $this->db->beginTransaction();
            $balance = $this->getBalanceByUserId($userId);
            $finalBalance = $amount + $balance;

            $data = [
                'userId' => $userId,
                'category' => 'Deposit',
                'type' => 'Debit',
                'amount' => $amount,
                'balance' => $finalBalance,
                'note' => null
            ];

            $this->create($data);
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    public function withdraw($userId, $amount)
    {
        $balance = $this->getBalanceByUserId($userId);
        $finalBalance = $balance - $amount;

        if ($finalBalance < 0) {
            throw new Error('Your balance is insufficient');
        }

        $data = [
            'userId' => $userId,
            'category' => 'Withdraw',
            'type' => 'Credit',
            'amount' => $amount,
            'balance' => $finalBalance,
            'note' => null
        ];
        return $this->create($data);
    }

    public function getBalanceByUserId($userId, $forUpdate = false)
    {
        $query = "SELECT balance FROM {$this->table} WHERE user_id = :userId ORDER BY created_at DESC";
        
        if ($forUpdate) {
            $query .= ' FOR UPDATE';
        }

        $this->db->query($query);
        $this->db->bind(':userId', $userId);
        $result = $this->db->first();
        $balance = 0;

        if ($result) {
            $balance = $result->balance;
        }

        return $balance;
    }

    public function transfer($amount, $sender, $recipient)
    {
        try {
            $this->db->beginTransaction();
            $senderBalance = $this->getBalanceByUserId($sender->id, true);
    
            if ($amount > $senderBalance) {
                throw new Error('Your balance is insufficient');
            }
    
            $recipientBalance = $this->getBalanceByUserId($recipient->id, true);
            $finalSenderBalance = $senderBalance - $amount;
            $finalRecipientBalance = $recipientBalance + $amount;
    
            $insertSenderData = [
                'userId' => $sender->id,
                'category' => 'Transfer',
                'type' => 'Credit',
                'amount' => $amount,
                'balance' => $finalSenderBalance,
                'note' => 'Transfer to ' . $recipient->name
            ];
            $this->create($insertSenderData);
    
            $insertRecipientData = [
                'userId' => $recipient->id,
                'category' => 'Transfer',
                'type' => 'Debit',
                'amount' => $amount,
                'balance' => $finalRecipientBalance,
                'note' => 'Transfer from ' . $sender->name
            ];
            $this->create($insertRecipientData);
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    public function create($data)
    {
        $this->db->query("INSERT INTO {$this->table} (user_id, category, type, amount, balance, note) VALUES(:userId, :category, :type, :amount, :balance, :note)");
        $this->db->bind(':userId', $data['userId']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':balance', $data['balance']);
        $this->db->bind(':note', $data['note']);
        return $this->db->execute();
    }
}
