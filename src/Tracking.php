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
     * @return \ParcelGoClient\Response\TrackingSimple
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
     * @param Core\RequestParam\Tracking $trackingRequest
     * @return Response\TrackingSimple
     * @throws EmptySlug
     * @throws EmptyTrackingNumber
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function edit($courierSlug, $trackingNumber, \ParcelGoClient\Core\RequestParam\Tracking $trackingRequest = null)
    {
        if (empty($courierSlug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        $tracking = array('tracking_number' => $trackingNumber, 'courier_slug' => $courierSlug);
        $requestParams = array_merge($tracking, $trackingRequest->toArray());
        $response = new Response($this->getRequest()->call('updateTracking', array('tracking' => $requestParams)));
        return $response->trackingEdit();
    }

    /**
     * @param $courierSlug
     * @param $trackingNumber
     * @return Response\TrackingSimple
     * @throws EmptySlug
     * @throws EmptyTrackingNumber
     * @throws \Exception
     * @throws \Guzzle\Common\Exception\GuzzleException
     */
    public function delete($courierSlug, $trackingNumber)
    {
        if (empty($courierSlug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        $tracking = array('tracking_number' => $trackingNumber, 'courier_slug' => $courierSlug);
        $response = new Response($this->getRequest()->call('deleteTracking', $tracking));
        return $response->trackingDelete();
    }

    /**
     * @param $courierSlug
     * @param $trackingNumber
     * @return Response\TrackingSimple
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
