<?php

namespace Trainjunkies\Hsp\NationalRail;

use Trainjunkies\Hsp\Exception\MissingCredentials as MissingCredentialsException;

class Authentication
{
    private $username;
    private $password;

    private function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public static function fromUsernameAndPassword($username, $password)
    {
        if ((strlen($username) === 0) || (strlen($password) === 0)) {
            throw new MissingCredentialsException('Missing username and/or password');
        }

        return new self($username, $password);
    }

    public function username()
    {
        return $this->username;
    }

    public function password()
    {
        return $this->password;
    }
}
