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
        $response = new Response($this->getRequest()->send('couriers', 'GET'));
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

        $query = http_build_query(
            array(
                'tracking_number' => $trackingNumber
            )
        );
        $response = new Response($this->getRequest()->send('couriers/detect?' . $query, 'GET'));
        return $response->courierDetect();
    }
}
