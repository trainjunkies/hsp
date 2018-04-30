<?php

namespace Trainjunkies\Hsp\Http;

interface Adapter
{
    const BASE_URI = 'https://hsp-prod.rockshore.net/api/v1/';

    /**
     * @param $uri
     * @param $options
     *
     * @return mixed
     * @throws \Trainjunkies\Hsp\Exception\Http
     */
    public function post($uri, $options);
}
