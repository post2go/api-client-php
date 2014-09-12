<?php
namespace Post2GoClient;

use Post2GoClient\Exception\EmptySlug;
use Post2GoClient\Exception\EmptyTrackingNumber;

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
     * @return \Post2GoClient\Response\LastCheckPoint
     */
    public function get($courierSlug, $trackingNumber)
    {
        if (empty($courierSlug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        $tracking = array('tracking_number' => $trackingNumber, 'courier_slug' => $courierSlug);
        $response = new Response($this->getRequest()->call('getLastCheckpoint', $tracking));
        return $response->lastCheckPoint();
    }
} 