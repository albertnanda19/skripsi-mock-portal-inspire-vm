<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;
use App\Entities\UserEntity;

class UserRepository implements UserRepositoryInterface 
{
    protected $userModel;
    protected $db;
    public function __construct()
    {
        $this->userModel = new User();
        $this->db = \Config\Database::connect();
    }

    
    public function getUserByUsername(string $username): ?UserEntity
    {
        return $this->userModel->where('username', $username)->first();
    }

    
    public function getUsersByRole(string $roleId): array
    {
        return $this->userModel->where('role_id', $roleId)->findAll();
    }

    
    public function getUserByName(string $name): ?array
    {
        return $this->userModel->where('name', $name)->findAll();
    }
}