<?php

namespace Post2GoClient;

use Post2GoClient\Exception\EmptyTrackingNumber;

class Couriers extends Base
{
    /**
     * Return couriers list.
     *
     * @return \Post2GoClient\Response\Couriers
     */
    public function get()
    {
        $response = new Response($this->getRequest()->call('getCouriers'));

        return $response->couriers();
    }

    /**
     * Return couriers that can use this tracking number.
     *
     * @param $trackingNumber
     * @return \Post2GoClient\Response\CourierDetect
     * @throws \Post2GoClient\Exception\EmptyTrackingNumber
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

    /**
     * Soft detect method.
     * Return all couriers except couriers that can't use this tracking number.
     *
     * @param $trackingNumber
     * @return \Post2GoClient\Response\CourierDetect
     * @throws \Post2GoClient\Exception\EmptyTrackingNumber
     */
    public function validFor($trackingNumber)
    {
        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber();
        }

        $response = new Response($this->getRequest()->call('validForCourier', array(
            'tracking_number' => $trackingNumber
        )));

        return $response->courierDetect();
    }
}
