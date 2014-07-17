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

        $data = array('tracking_number' => $trackingNumber, 'courier_slug' => $courierSlug);
        $raw = $this->getRequest()->send('trackings', 'POST', json_encode(array('tracking' => $data)));

        return (new Response($raw))->trackingCreate();
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

        $raw =  $this->request->send('trackings/' . $courierSlug . '/' . $trackingNumber, 'GET');
        return (new Response($raw))->tracking();
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

        $raw = $this->request->send('trackings/' . $courierSlug . '/' . $trackingNumber . '/reactivate', 'POST');
        return (new Response($raw))->trackingReactivate();
    }

}
