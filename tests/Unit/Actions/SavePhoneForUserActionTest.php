<?php

namespace Tests\Unit\Actions;

use App\Actions\SavePhoneForUser;
use App\User;
use Tests\TestCase;

class SavePhoneForUserActionTest extends TestCase
{
    private $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new SavePhoneForUser();
    }

    public function testShouldReturnPhoneWhenPhoneIsValid()
    {
        $result = $this->action->execute(new User(), '123456');
        $this->assertSame('123456', $result);
    }

    public function testShouldThrowExceptionWhenPhoneIsEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Phone cannot be an empty string');
        $this->action->execute(new User(), '');
    }
}
