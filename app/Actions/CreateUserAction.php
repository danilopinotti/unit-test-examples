<?php

namespace App\Actions;

use App\Repositories\UserRepository;

class CreateUserAction
{
    public function execute(array $data, UserRepository $userRepository, SavePhoneForUserAction $savePhoneForUserAction)
    {
        if (count($data) === 0) {
            throw new \InvalidArgumentException('Data cannot be empty.');
        }

        $user = $userRepository->create($data);

        if ($phone = data_get($data, 'phone')) {
            $savePhoneForUserAction->execute($user, $phone);
        }

        return $user;
    }
}
