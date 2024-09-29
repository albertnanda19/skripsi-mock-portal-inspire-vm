<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{    
    public function getUserByUsername(string $username): ?array;  
    public function getUsersByRole(string $roleId): array;
    public function getUserByName(string $name): ?array;
    
}