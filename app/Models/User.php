<?php

namespace App\Models;

use Core\Database;

class User {
    private $db;
    private $table = 'users';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUserById($id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->first();
    }

    public function getUserByUsername($username)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE username = :username");
        $this->db->bind(':username', $username);
        return $this->db->first();
    }
}
