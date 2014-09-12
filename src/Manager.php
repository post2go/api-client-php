<?php
namespace Post2GoClient;

class Manager
{
    protected $request;

    /**
     * @param string $apiKey
     * @param string $endpoint
     * @param array $guzzlePlugins
     */
    public function __construct($apiKey, $endpoint = '', $guzzlePlugins = array())
    {
        $this->request = new Core\Request($apiKey, $endpoint, $guzzlePlugins);
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
