<?php

namespace Trainjunkies\Hsp\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Trainjunkies\Hsp\Exception\Http as HttpException;

class GuzzleAdapter implements Adapter
{
    /**
     * @var Client
     */
    private $guzzleHttp;

    public function __construct(Client $guzzleHttp)
    {
        $this->guzzleHttp = $guzzleHttp;
    }

    public function post($uri, $options)
    {
        try {
            return $this->guzzleHttp->post($uri, $options)->getBody();
        } catch (ClientException $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
