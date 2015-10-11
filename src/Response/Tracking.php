<?php
namespace Post2GoClient\Response;

use Post2GoClient\Response\ValueObject\Checkpoint;

class Tracking
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
    private $isDelivered;

    /**
     * @var \DateTime
     */
    private $lastCheck;

    /**
     * @var Checkpoint[]
     */
    private $checkpoints = [];

    public function __construct($data)
    {
        $this->trackingNumber = $data['tracking_number'];
        $this->courierSlug = $data['courier_slug'];
        $this->isDelivered = $data['is_delivered'];
        $this->lastCheck = new \DateTime($data['last_check']);
        foreach ($data['checkpoints'] as $checkpoint) {
            $this->checkpoints[] = new Checkpoint(
                $checkpoint['time'],
                $checkpoint['status'],
                $checkpoint['location'],
                $checkpoint['zip_code'],
                $checkpoint['country_code'],
                $checkpoint['courier_slug'],
                $checkpoint['message']
            );
        }
    }

    /**
     * @return ValueObject\Checkpoint[]
     */
    public function getCheckpoints()
    {
        return $this->checkpoints;
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
    public function isDelivered()
    {
        return $this->isDelivered;
    }

    /**
     * @return \DateTime
     */
    public function getLastCheck()
    {
        return $this->lastCheck;
    }

    /**
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }
}