<?php
namespace ParcelGoClient\Response;

use ParcelGoClient\Response\ValueObject\Track;

class CourierDetect
{
    /**
     * @var Courier[]
     */
    private $couriers;

    /**
     * @var int
     */
    private $total;

    /**
     * @var string
     */
    private $trackingNumber;

    public function __construct($data)
    {
        $this->total = $data['total'];
        $this->trackingNumber = $data['tracking_number'];
        foreach ($data['couriers'] as $courier) {
            $this->couriers[] = new Track($courier['name'], $courier['slug'], $courier['country_code']);
        }
    }

    /**
     * @return ValueObject\Courier[]
     */
    public function getCouriers()
    {
        return $this->couriers;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }



}