<?php

namespace spec\Trainjunkies\Hsp\NationalRail;

use Trainjunkies\Hsp\Exception\MissingCredentials;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthenticationSpec extends ObjectBehavior
{
    const USERNAME = 'user@example.com';
    const PASSWORD = '£ecR3t??';

    function it_has_username_and_password()
    {
        $this->beConstructedFromUsernameAndPassword(self::USERNAME, self::PASSWORD);
        $this->username()->shouldBe(self::USERNAME);
        $this->password()->shouldBe(self::PASSWORD);
    }

    function it_should_throw_exception_when_missing_username_or_password()
    {
        $this->beConstructedFromUsernameAndPassword(self::USERNAME, '');
        $this->shouldThrow(MissingCredentials::class)->duringInstantiation();

        $this->beConstructedFromUsernameAndPassword('', self::PASSWORD);
        $this->shouldThrow(MissingCredentials::class)->duringInstantiation();

        $this->beConstructedFromUsernameAndPassword('', '');
        $this->shouldThrow(MissingCredentials::class)->duringInstantiation();
    }
}
