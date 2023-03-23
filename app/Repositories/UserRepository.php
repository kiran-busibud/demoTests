<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements IUserRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function getUserById($id)
    {
        return $this->user->findOrFail($id);
    }

    public function create(User $user)
    {
        $user->save();
    }

}
