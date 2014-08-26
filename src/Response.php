<?php
namespace ParcelGoClient;

use ParcelGoClient\Exception\Response\AuthRequired;
use ParcelGoClient\Exception\Response\BadRequest;
use ParcelGoClient\Exception\Response\Base as BaseException;
use ParcelGoClient\Exception\Response\MethodNotAllowed;
use ParcelGoClient\Exception\Response\ServerError;

class Response
{
    /**
     * @var array
     */
    private $data;

    public function __construct($data)
    {
        if (empty($data['error']) && !empty($data['result'])) {
            $this->data = $data['result'];
        } else {
            if (empty($data['error']['code'])) {
                $data['error']['code'] = 0;
            }
            if (empty($data['error']['message'])) {
                $data['error']['message'] = 'Unknown error';
            }

            switch ($data['error']['code']) {
                case 400:
                    throw new BadRequest($data['error']['message'], $data['error']['code']);
                    break;
                case 500:
                    throw new ServerError($data['error']['message'], $data['error']['code']);
                    break;
                case 401:
                    throw new AuthRequired($data['error']['message'], $data['error']['code']);
                    break;
                case 405:
                    throw new MethodNotAllowed($data['error']['message'], $data['error']['code']);
                    break;
                default:
                    throw new BaseException($data['error']['message'], $data['error']['code']);
            }
        }

    }

    /**
     * @return array
     */
    protected function getData()
    {
        return $this->data;
    }

    /**
     * @return Response\Couriers
     */
    public function couriers()
    {
        return new Response\Couriers($this->getData());
    }

    /**
     * @return Response\CourierDetect
     */
    public function courierDetect()
    {
        return new Response\CourierDetect($this->getData());
    }

    /**
     * @return Response\TrackingCreate
     */
    public function trackingCreate()
    {
        return new Response\TrackingCreate($this->getData());
    }

    /**
     * @return Response\Tracking
     */
    public function tracking()
    {
        return new Response\Tracking($this->getData());
    }

    /**
     * @return Response\TrackingReactivate
     */
    public function trackingReactivate()
    {
        return new Response\TrackingReactivate($this->getData());
    }

    /**
     * @return Response\LastCheckPoint
     */
    public function lastCheckPoint()
    {
        return new Response\LastCheckPoint($this->getData());
    }
}