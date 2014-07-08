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
        if ($this->client === null) {
            $this->client = new \ParcelGoClient\Manager(API_KEY);
        }
        return $this->client;
    }

}