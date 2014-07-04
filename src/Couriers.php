<?php

namespace ParcelGoClient;

use ParcelGoClient\Core\Request;
use ParcelGoClient\Exception\EmptyTrackingNumber;

class Couriers
{
    private $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return array|bool|float|int|string
     */
    public function get()
    {
        return $this->request->send('couriers', 'GET');
    }

    /**
     * @param $trackingNumber
     * @return array
     * @throws Exception\EmptyTrackingNumber
     */
    public function detect($trackingNumber)
    {
        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber();
        }

        $result = $this->request->send('couriers/detect/' . $trackingNumber, 'GET');

        return !empty($result['data']['couriers']) ? $result['data']['couriers'] : array();
    }

    /**
     * @return array
     */
    public function listCouriers()
    {
        $result = $this->request->send('couriers/list/', 'GET');

        return !empty($result['data']) ? $result['data'] : array();
    }
}
