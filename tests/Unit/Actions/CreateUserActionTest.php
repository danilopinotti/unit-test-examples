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
        $result = $this->action->execute(['name' => 'Danilo'], new UserRepository());
        $this->assertInstanceOf(User::class, $result);
    }

    public function testShouldThrowExceptionWhenDataIsEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Data cannot be empty.');
        $this->action->execute([], new UserRepository());
    }
}
