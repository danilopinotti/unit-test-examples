<?php

namespace Tests\Unit\Actions;

use App\Actions\SavePhoneForUserAction;
use App\User;
use Mockery as m;
use Tests\TestCase;

class SavePhoneForUserActionTest extends TestCase
{
    private $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new SavePhoneForUserAction();
    }

    public function testShouldReturnPhoneWhenPhoneIsValid()
    {
        $user = m::mock(User::class);
        $user->shouldReceive('savePhone')
            ->once();

        $result = $this->action->execute($user, '123456');
        $this->assertSame('123456', $result);
    }

    public function testShouldThrowExceptionWhenPhoneIsEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Phone cannot be an empty string');
        $this->action->execute(new User(), '');
    }
}
