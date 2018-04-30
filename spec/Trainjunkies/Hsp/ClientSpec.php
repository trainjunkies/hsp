<?php

namespace spec\Trainjunkies\Hsp;

use Trainjunkies\Hsp\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Trainjunkies\Hsp\Exception\NotAuthorized;
use Trainjunkies\Hsp\Exception\RIDNotFound;
use Trainjunkies\Hsp\Http\Adapter;
use Trainjunkies\Hsp\NationalRail\ApiCalls\ServiceDetails;
use Trainjunkies\Hsp\NationalRail\Authentication;

class ClientSpec extends ObjectBehavior
{
    const RID = '201804098951203';

    function let(
        ServiceDetails $serviceDetails

    ) {
        $this->beConstructedWith($serviceDetails);
    }

    function it_has_service_details_request(
        ServiceDetails $serviceDetails
    ) {

        $this->getServiceDetails(self::RID);

        $serviceDetails->getServiceDetailsByRid(self::RID)->shouldHaveBeenCalled();
    }

    function it_throws_exception_when_not_authorized(
        ServiceDetails $serviceDetails
    ) {
        $serviceDetails->getServiceDetailsByRid(self::RID)->willThrow(NotAuthorized::class);

        $this->shouldThrow(NotAuthorized::class)->duringGetServiceDetails(self::RID);
    }

    function it_throws_exception_when_rid_not_found(
        ServiceDetails $serviceDetails
    ) {
        $serviceDetails->getServiceDetailsByRid(self::RID)->willThrow(RIDNotFound::class);

        $this->shouldThrow(RIDNotFound::class)->duringGetServiceDetails(self::RID);
    }
}
