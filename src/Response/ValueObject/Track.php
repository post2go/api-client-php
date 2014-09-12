<?php
namespace Post2GoClient\Response\ValueObject;

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
     * @param string $courierSlug
     * @param string $trackingNumber
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