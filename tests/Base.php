<?php
namespace ParcelGoClient\Tests;

abstract class Base extends \PHPUnit_Framework_TestCase
{

    const USPS_SLUG = 'usps';
    const USPS_TRACKING_NUMBER = 'EC208786464US';
    /**
     * @var \ParcelGoClient\Manager
     */
    private $client = null;

    public function getClient()
    {
        if (!($apiKey = getenv('API_KEY'))) {
            $apiKey = API_KEY;
        }
        if (!($endPoint = getenv('END_POINT'))) {
            $endPoint = END_POINT;
        }
        if ($this->client === null) {
            $this->client = new \ParcelGoClient\Manager($apiKey, $endPoint);
        }
        return $this->client;
    }

}