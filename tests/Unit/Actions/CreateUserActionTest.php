<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateUserAction;
use App\Actions\SavePhoneForUserAction;
use App\Repositories\UserRepository;
use App\User;
use Mockery as m;
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
//      $userRepository = m::mock(UserRepository::class);
//      $userRepository->shouldReceive('create')->once();
        $this->mock(UserRepository::class, function ($mock) {
            $mock->shouldReceive('create')->once();
        });

        $result = $this->action->execute(['name' => 'Danilo']);

        $this->assertInstanceOf(User::class, $result);
    }

    public function testShouldNotSavePhoneWhenNotPassPhoneData()
    {
//      $userRepository = m::mock(UserRepository::class);
//      $userRepository->shouldReceive('create')->once();
        $this->mock(UserRepository::class, function ($mock) {
            $mock->shouldReceive('create')->once();
        });

//      $savePhoneAction = m::mock(SavePhoneForUserAction::class);
//      $savePhoneAction->shouldReceive('execute')->never();
        $this->mock(SavePhoneForUserAction::class, function ($mock) {
            $mock->shouldReceive('execute')->never();
        });

        $result = $this->action->execute(['name' => 'Danilo']);

        $this->assertInstanceOf(User::class, $result);
    }

    public function testShouldSavePhoneWhenPassPhoneData()
    {
//      $userRepository = m::mock(UserRepository::class);
//      $userRepository->shouldReceive('create')->once();
        $this->mock(UserRepository::class, function ($mock) {
            $mock->shouldReceive('create')->once();
        });

//      $savePhoneAction = m::mock(SavePhoneForUserAction::class);
//      $savePhoneAction->shouldReceive('execute')->never();
        $this->mock(SavePhoneForUserAction::class, function ($mock) {
            $mock->shouldReceive('execute')->once();
        });

        $result = $this->action
            ->execute(['name' => 'Danilo', 'phone' => '123']);

        $this->assertInstanceOf(User::class, $result);
    }

    public function testShouldThrowExceptionWhenDataIsEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Data cannot be empty.');
        $this->action->execute([]);
    }
}
