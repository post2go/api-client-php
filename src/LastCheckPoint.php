<?php
namespace ParcelGoClient;

use ParcelGoClient\Exception\EmptySlug;
use ParcelGoClient\Exception\EmptyTrackingNumber;

class LastCheckPoint extends Base
{
    /**
     * Return the tracking information of the last checkpoint of a single tracking.
     *
     * @param $courierSlug
     * @param $trackingNumber
     *
     * @throws Exception\EmptySlug
     * @throws Exception\EmptyTrackingNumber
     * @return mixed
     */
    public function get($courierSlug, $trackingNumber)
    {
        if (empty($courierSlug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        return  $this->getRequest()->send('last-checkpoint/' . $courierSlug . '/' . $trackingNumber, 'GET');
    }
} 