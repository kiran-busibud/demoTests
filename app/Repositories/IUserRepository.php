<?php

namespace app\Repositories;

use App\Models\User;

interface IUserRepository
{
    public function getUserById($id);

    public function create(User $user);
  
}