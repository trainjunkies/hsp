<?php

namespace Trainjunkies\Hsp;

use Trainjunkies\Hsp\Exception\Http as HttpException;
use Trainjunkies\Hsp\Exception\NotAuthorized;
use Trainjunkies\Hsp\Exception\RIDNotFound;
use Trainjunkies\Hsp\NationalRail\ApiCalls\ServiceDetails;

class Client
{
    /**
     * @var ServiceDetails
     */
    private $serviceDetails;

    public function __construct(ServiceDetails $serviceDetails)
    {
        $this->serviceDetails = $serviceDetails;
    }

    public function getServiceDetails($rid)
    {
        return $this->apiCallHandler(function () use ($rid) {
            return $this->serviceDetails->getServiceDetailsByRid($rid);
        });
    }

    private function apiCallHandler(callable $function)
    {
        try {
            return $function();
        } catch (HttpException $e) {
            if ($e->getCode() === 401) {
                throw new NotAuthorized(
                    'Not authorized to view journey, please check your credentials and privileges',
                    $e->getCode(),
                    $e
                );
            }

            if ($e->getCode() == 404) {
                throw new RIDNotFound($e->getMessage(), $e->getCode(), $e);
            }

            throw $e;
        }
    }
}
