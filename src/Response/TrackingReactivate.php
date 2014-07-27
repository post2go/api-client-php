<?php
namespace ParcelGoClient\Response;

use ParcelGoClient\Response\ValueObject\Track;

class TrackingReactivate
{

    /**
     * @var Track
     */
    private $tracking;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $track = $data['tracking'];
        $this->tracking = new Track($track['courier_slug'], $track['tracking_number']);
    }

    /**
     * @return ValueObject\Track
     */
    public function getTracking()
    {
        return $this->tracking;
    }


}