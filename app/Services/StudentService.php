<?php

namespace App\Services;

use App\Repositories\UserRepository;

class StudentService
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
}