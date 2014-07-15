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
     * @return array|bool
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

        return $this->request->send('trackings', 'POST', json_encode(array('tracking' => $data)));
    }

    /**
     * @param $courierSlug
     * @param $trackingNumber
     * @throws Exception\EmptySlug
     * @throws Exception\EmptyTrackingNumber
     * @return array|bool
     */
    public function get($courierSlug, $trackingNumber)
    {
        if (empty($courierSlug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        return $this->request->send('trackings/' . $courierSlug . '/' . $trackingNumber, 'GET');
    }

    public function reactivate($courierSlug, $trackingNumber)
    {
        if (empty($courierSlug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        return $this->request->send('trackings/' . $courierSlug . '/' . $trackingNumber . '/reactivate', 'POST');
    }

}
