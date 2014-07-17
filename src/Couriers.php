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
        return (new Response($this->getRequest()->send('couriers', 'GET')))->couriers();
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

        return (new Response($this->getRequest()->send('couriers/detect/' . $trackingNumber, 'GET')))->courierDetect();
    }
}
