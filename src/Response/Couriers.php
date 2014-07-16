<?php
namespace ParcelGoClient\Response;

use ParcelGoClient\Response\ValueObject\Track;

class Couriers
{
    /**
     * @var Courier[]
     */
    private $couriers;

    public function __construct($couriers)
    {
        foreach ($couriers as $courier) {
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

}