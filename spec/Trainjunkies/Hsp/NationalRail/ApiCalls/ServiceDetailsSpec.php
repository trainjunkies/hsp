<?php

namespace spec\Trainjunkies\Hsp\NationalRail\ApiCalls;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\StreamInterface;
use Trainjunkies\Hsp\NationalRail\ApiCalls\ServiceDetails;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Trainjunkies\Hsp\Http\Adapter as HttpAdapter;
use Trainjunkies\Hsp\NationalRail\Authentication;

class ServiceDetailsSpec extends ObjectBehavior
{
    const RID = 'HKGKGKGK';
    const AUTH_USERNAME = 'username';
    const AUTH_PASSWORD = 'Pa$$W0rd';

    function it_is_initializable(
        HttpAdapter $httpAdapter,
        Response $response
    ) {
        $authentication = Authentication::fromUsernameAndPassword(
            self::AUTH_USERNAME,
            self::AUTH_PASSWORD
        );

        $expectedJsonString = <<<JSON
{"serviceAttributesDetails":{"date_of_service":"2018-04-09","toc_code":"NT","rid":"201804098951203","locations":[{"location":"SOT","gbtt_ptd":"0630","gbtt_pta":"","actual_td":"0630","actual_ta":"","late_canc_reason":""},{"location":"LPT","gbtt_ptd":"0634","gbtt_pta":"0634","actual_td":"0634","actual_ta":"0633","late_canc_reason":""},{"location":"KDG","gbtt_ptd":"0638","gbtt_pta":"0638","actual_td":"0639","actual_ta":"0638","late_canc_reason":""},{"location":"CNG","gbtt_ptd":"0645","gbtt_pta":"0645","actual_td":"0645","actual_ta":"0644","late_canc_reason":""},{"location":"MAC","gbtt_ptd":"0653","gbtt_pta":"0652","actual_td":"0653","actual_ta":"0651","late_canc_reason":""},{"location":"PRB","gbtt_ptd":"0657","gbtt_pta":"0657","actual_td":"0656","actual_ta":"0656","late_canc_reason":""},{"location":"ADC","gbtt_ptd":"0700","gbtt_pta":"0700","actual_td":"0700","actual_ta":"0659","late_canc_reason":""},{"location":"PYT","gbtt_ptd":"0704","gbtt_pta":"0703","actual_td":"0704","actual_ta":"0702","late_canc_reason":""},{"location":"BML","gbtt_ptd":"0707","gbtt_pta":"0706","actual_td":"0707","actual_ta":"0706","late_canc_reason":""},{"location":"CHU","gbtt_ptd":"0711","gbtt_pta":"0710","actual_td":"0710","actual_ta":"0709","late_canc_reason":""},{"location":"SPT","gbtt_ptd":"0716","gbtt_pta":"0715","actual_td":"0715","actual_ta":"0713","late_canc_reason":""},{"location":"MAN","gbtt_ptd":"","gbtt_pta":"0725","actual_td":"","actual_ta":"0728","late_canc_reason":""}]}}
JSON;

        $expectedJsonResponse = json_decode($expectedJsonString, true);

        $expectedHttpOptions = [
            'base_uri' => 'https://hsp-prod.rockshore.net/api/v1/',
            'auth'     => [
                self::AUTH_USERNAME,
                self::AUTH_PASSWORD,
                'basic'
            ],
            'json'     => ['rid' => self::RID]
        ];

        $response->getBody()->willReturn($expectedJsonString);
        $httpAdapter->post('serviceDetails', $expectedHttpOptions)->willReturn($response);

        $this->beConstructedWith($httpAdapter, $authentication);
        $this->shouldHaveType(ServiceDetails::class);
        $this->getServiceDetailsByRid(self::RID)->shouldBe($expectedJsonResponse);

        $httpAdapter->post('serviceDetails', $expectedHttpOptions)->shouldHaveBeenCalled();
    }
}
