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