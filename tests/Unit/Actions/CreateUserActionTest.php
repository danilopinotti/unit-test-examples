<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateUserAction;
use App\Repositories\UserRepository;
use App\User;
use Tests\TestCase;

class CreateUserActionTest extends TestCase
{
    private $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new CreateUserAction();
    }

    public function testShouldReturnUserWhenHasValidData()
    {
        $user = $this->action->execute(['name' => 'Danilo'], new UserRepository());

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseMissing('user_phones', [
            'user_id' => $user->id,
        ]);
    }

    public function testShouldReturnUserWhenHasValidDataAndSavePhone()
    {
        $user = $this->action
            ->execute(
                ['name' => 'Danilo', 'phone' => '123456'],
                new UserRepository()
            );
        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('user_phones', [
            'user_id' => $user->id,
            'phone' => '123456'
        ]);
    }

    public function testShouldThrowExceptionWhenDataIsEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Data cannot be empty.');
        $this->action->execute([], new UserRepository());
    }
}
