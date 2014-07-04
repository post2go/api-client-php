<?php
namespace ParcelGoClient;

class Manager
{
    protected $request;

    /**
     * @param $endpoint
     * @param string $apiKey
     * @param array $guzzlePlugins
     */
    public function __construct($endpoint, $apiKey, $guzzlePlugins = [])
    {
        $this->request = new Core\Request($endpoint, $apiKey, $guzzlePlugins);
    }

    /**
     * @return Couriers
     */
    public function couriers()
    {
        return new Couriers($this->request);
    }

    /**
     * @return Tracking
     */
    public function tracking()
    {
        return new Tracking($this->request);
    }

    /**
     * @return LastCheckPoint
     */
    public function lastCheckpoint()
    {
        return new LastCheckPoint($this->request);
    }
}
