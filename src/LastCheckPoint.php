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
     * @return \ParcelGoClient\Response\LastCheckPoint
     */
    public function get($courierSlug, $trackingNumber)
    {
        if (empty($courierSlug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        $query = http_build_query(
            array(
                'tracking_number' => $trackingNumber
            )
        );

        $rawResponse = $this->getRequest()->send('last-checkpoint/' . $courierSlug . '?' . $query, 'GET');
        $response = new Response($rawResponse);
        return $response->lastCheckPoint();
    }
} 