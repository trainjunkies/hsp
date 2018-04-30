<?php

namespace Trainjunkies\Hsp\NationalRail\ApiCalls;

use GuzzleHttp\Psr7\Response;
use Trainjunkies\Hsp\Http\Adapter as HttpAdapter;
use Trainjunkies\Hsp\NationalRail\Authentication;

class ServiceDetails
{
    /**
     * @var HttpAdapter
     */
    private $httpAdapter;
    /**
     * @var \Trainjunkies\Hsp\NationalRail\Authentication
     */
    private $authentication;

    public function __construct(
        HttpAdapter $httpAdapter,
        Authentication $authentication
    ) {
        $this->httpAdapter = $httpAdapter;
        $this->authentication = $authentication;
    }

    public function getServiceDetailsByRid($rid)
    {
        /** @var Response $result */
        $result = $this->httpAdapter->post('serviceDetails', $this->httpRequestOptions($rid));
        return json_decode($result->getBody(), true);
    }

    private function httpRequestOptions($rid)
    {
        return [
            'base_uri' => HttpAdapter::BASE_URI,
            'auth'     => [
                $this->authentication->username(),
                $this->authentication->password(),
                'basic'
            ],
            'json'     => ['rid' => $rid]
        ];
    }
}
