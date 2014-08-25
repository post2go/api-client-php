<?php
namespace ParcelGoClient;

use ParcelGoClient\Exception\EmptySlug;
use ParcelGoClient\Exception\EmptyTrackingNumber;

class Tracking extends Base
{
    /**
     * @param $courierSlug
     * @param $trackingNumber
     * @throws Exception\EmptySlug
     * @throws Exception\EmptyTrackingNumber
     * @return \ParcelGoClient\Response\TrackingCreate
     */
    public function create($courierSlug, $trackingNumber)
    {
        if (empty($courierSlug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        $tracking = array('tracking_number' => $trackingNumber, 'courier_slug' => $courierSlug);
        $response = new Response($this->getRequest()->call('addTracking', array('tracking' => $tracking)));
        return $response->trackingCreate();
    }

    /**
     * @param $courierSlug
     * @param $trackingNumber
     * @throws Exception\EmptySlug
     * @throws Exception\EmptyTrackingNumber
     * @return \ParcelGoClient\Response\Tracking
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
        $response = new Response($this->getRequest()->call('getTrackingInfo', $tracking));
        return $response->tracking();
    }

    /**
     * @param $courierSlug
     * @param $trackingNumber
     * @return Response\TrackingReactivate
     * @throws Exception\EmptySlug
     * @throws Exception\EmptyTrackingNumber
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function reactivate($courierSlug, $trackingNumber)
    {
        if (empty($courierSlug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        $tracking = array('tracking_number' => $trackingNumber, 'courier_slug' => $courierSlug);
        $response = new Response($this->getRequest()->call('reactivateTracking', $tracking));
        return $response->trackingReactivate();
    }

}
