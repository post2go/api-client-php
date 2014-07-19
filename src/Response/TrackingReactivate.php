<?php
namespace ParcelGoClient\Response;

class TrackingReactivate
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
     * @param array $data
     */
    public function __construct($data)
    {
        $this->trackingNumber = $data['tracking_number'];
        $this->courierSlug = $data['courier_slug'];
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