<?php
namespace ParcelGoClient;

use ParcelGoClient\Exception\EmptySlug;
use ParcelGoClient\Exception\EmptyTrackingNumber;

class Tracking extends Base
{
    /**
     * @param $slug
     * @param $trackingNumber
     * @throws Exception\EmptySlug
     * @throws Exception\EmptyTrackingNumber
     * @return array|bool
     */
    public function create($slug, $trackingNumber)
    {
        if (empty($slug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        $data = ['tracking_number' => $trackingNumber, 'slug' => $slug];

        return $this->request->send('trackings', 'POST', json_encode(array('tracking' => $data)));
    }

    /**
     * @param $slug
     * @param $trackingNumber
     * @throws Exception\EmptySlug
     * @throws Exception\EmptyTrackingNumber
     * @return array|bool
     */
    public function get($slug, $trackingNumber)
    {
        if (empty($slug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        return $this->request->send('trackings/' . $slug . '/' . $trackingNumber, 'GET');
    }

    public function reactivate($slug, $trackingNumber)
    {
        if (empty($slug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        return $this->request->send('trackings/' . $slug . '/' . $trackingNumber . '/reactivate', 'POST');
    }

}
