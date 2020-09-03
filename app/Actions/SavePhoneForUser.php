<?php


namespace App\Actions;

use App\User;

class SavePhoneForUser
{
    public function execute(User $user, string $phone): string
    {
        if ($phone === '') {
            throw new \InvalidArgumentException('Phone cannot be an empty string');
        }

        $user->savePhone($phone);

        return $phone;
    }
}
