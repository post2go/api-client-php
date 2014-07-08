<?php

namespace ParcelGoClient;

use ParcelGoClient\Exception\EmptyTrackingNumber;

class Couriers extends Base
{

    /**
     * @return array|bool
     */
    public function get()
    {
        return $this->getRequest()->send('couriers', 'GET');
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

        return $this->getRequest()->send('couriers/detect/' . $trackingNumber, 'GET');
    }
}
