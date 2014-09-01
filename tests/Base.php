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
            $apiKey = '1648746cb7aa2a97e9061e8d651d7be7b01901d9019d4c0df87488a8799709d99d31a4d2913da104';
        }
        if ($this->client === null) {
            $this->client = new \ParcelGoClient\Manager($apiKey);
        }


        return $this->client;
    }

    public function createTrack()
    {
        $this->getClient()->tracking()->create(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);
    }

}