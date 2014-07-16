<?php
namespace ParcelGoClient\Response\ValueObject;

class Track
{

    /**
     * @var string
     */
    private $trackingNumber;

    /**
     * @var string
     */
    private $courierSlug;


    /**
     * @param $courierSlug
     * @param $trackingNumber
     */
    public function __construct($courierSlug, $trackingNumber)
    {
        $this->courierSlug = $courierSlug;
        $this->trackingNumber = $trackingNumber;
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
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }



}