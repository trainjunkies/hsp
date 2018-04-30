<?php

namespace Trainjunkies\Hsp;

use Trainjunkies\Hsp\Http\Factory as HttpFactory;
use Trainjunkies\Hsp\NationalRail\ApiCalls\ServiceDetails;
use Trainjunkies\Hsp\NationalRail\Authentication;

class ClientFactory
{
    public static function create($username, $password)
    {
        return new Client(
            new ServiceDetails(
                HttpFactory::create(),
                Authentication::fromUsernameAndPassword($username, $password)
            )
        );
    }
}
