<?php

namespace App\Actions;

use App\Repositories\UserRepository;

class CreateUserAction
{
    public function execute(array $data)
    {
        if (count($data) === 0) {
            throw new \InvalidArgumentException('Data cannot be empty.');
        }

        $user = UserRepository::resolve()->create($data);

        if ($phone = data_get($data, 'phone')) {
            app(SavePhoneForUserAction::class)->execute($user, $phone);
        }

        return $user;
    }
}
