<?php
namespace ParcelGoClient\Response\ValueObject;

class Checkpoint
{

    /**
     * @var string
     */
    private $time;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $zipCode;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var string
     */
    private $courierSlug;

    /**
     * @var string
     */
    private $message;

    /**
     * @param $time
     * @param $status
     * @param $location
     * @param $zipCode
     * @param $countryCode
     * @param $courierSlug
     * @param $message
     */
    public function __construct($time, $status, $location, $zipCode, $countryCode, $courierSlug, $message)
    {
        $this->time = $time;
        $this->status = $status;
        $this->location = $location;
        $this->zipCode = $zipCode;
        $this->countryCode = $countryCode;
        $this->courierSlug = $courierSlug;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getCourierSlug()
    {
        return $this->courierSlug;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

}