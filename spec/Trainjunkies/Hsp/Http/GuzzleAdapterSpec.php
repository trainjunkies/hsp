<?php

namespace spec\Trainjunkies\Hsp\Http;

use GuzzleHttp\Client;
use Trainjunkies\Hsp\Http\Adapter;
use Trainjunkies\Hsp\Http\GuzzleAdapter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GuzzleAdapterSpec extends ObjectBehavior
{
    function it_can_perform_a_post_request
    (
        Client $guzzleClient
    ) {
        $this->beConstructedWith($guzzleClient);

        $this->shouldHaveType(GuzzleAdapter::class);
        $this->shouldImplement(Adapter::class);

        $this->post('/phake-endpoint', ['params' => ['key' => 'value']]);

        $guzzleClient->post('/phake-endpoint', ['params' => ['key' => 'value']])->shouldHaveBeenCalled();
    }
}
