<?php

namespace Trainjunkies\Hsp\Http;

use GuzzleHttp\Client as HttpClient;

class Factory
{
    /**
     * @return Adapter
     */
    public static function create()
    {
        return new GuzzleAdapter(new HttpClient);
    }
}
