<?php

namespace App\Services;

use App\Models\User;
use App\Repositories;


class UserService
{
    private $userRepository;

    public function __construct(Repositories\IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $userData)
    {
        $user = new User($userData);
        $this->userRepository->create($user);
    }
}