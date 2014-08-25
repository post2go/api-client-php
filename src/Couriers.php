<?php

namespace ParcelGoClient;

use ParcelGoClient\Exception\EmptyTrackingNumber;
use ParcelGoClient\Response\CourierDetect;

class Couriers extends Base
{
    /**
     * @return \ParcelGoClient\Response\Couriers
     */
    public function get()
    {
        $response = new Response($this->getRequest()->call('getCouriers'));
        return $response->couriers();
    }

    /**
     * @param $trackingNumber
     * @return CourierDetect
     * @throws Exception\EmptyTrackingNumber
     */
    public function detect($trackingNumber)
    {
        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber();
        }

        $response = new Response($this->getRequest()->call('detectCourier', array(
            'tracking_number' => $trackingNumber
        )));
        return $response->courierDetect();
    }
}
