<?php

namespace App\Repositories;

use App\User;
use App\Traits\Newable;

class UserRepository
{
    use Newable;
    
    public function create(array $data): User
    {
        return User::create($data);
    }
}
