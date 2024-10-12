<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getStudentUsers(): array
    {
        return $this->userRepository->getUsersByStudentRole();
    }

    public function getDosenUsers(): array
    {
        return $this->userRepository->getUsersByDosenRole();
    }
}