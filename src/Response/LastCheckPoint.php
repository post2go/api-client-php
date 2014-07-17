<?php
namespace ParcelGoClient\Response;

use ParcelGoClient\Response\ValueObject\Checkpoint;

class LastCheckPoint
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
     * @var string
     */
    private $status;

    /**
     * @var Checkpoint
     */
    private $checkpoint;

    public function __construct($data)
    {
        $this->trackingNumber = $data['tracking_number'];
        $this->courierSlug = $data['courier_slug'];
        $this->status = $data['status'];
        $checkpoint = $data['checkpoint'];
        $this->checkpoint = new Checkpoint(
            $checkpoint['time'],
            $checkpoint['status'],
            $checkpoint['location'],
            $checkpoint['zip_code'],
            $checkpoint['country_code'],
            $checkpoint['courier_slug'],
            $checkpoint['message']
        );
    }

    /**
     * @return Checkpoint
     */
    public function getCheckpoint()
    {
        return $this->checkpoint;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }


}