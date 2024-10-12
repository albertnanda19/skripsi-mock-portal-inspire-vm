<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Helpers\JWT;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticate($username, $password)
    {
        $user = $this->userRepository->getUserByUsername($username);
        if ($user && password_verify($password, $user->password)) {
            $claims = ['uid' => $user->user_id];
            return JWT::generateTokens($claims);
        }
        return null;
    }
}