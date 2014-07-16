<?php
namespace ParcelGoClient;

use ParcelGoClient\Exception\Response\AuthRequired;
use ParcelGoClient\Exception\Response\BadRequest;
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
        if (!array_key_exists('meta', $data)) {
            //exception
        }
        switch ($data['meta']['code']) {
            case 400:
                throw new BadRequest($data['meta']['error_message'], $data['meta']['code']);
                break;
            case 500:
                throw new ServerError($data['meta']['error_message'], $data['meta']['code']);
                break;
            case 401:
                throw new AuthRequired($data['meta']['error_message'], $data['meta']['code']);
                break;
            case 405:
                throw new MethodNotAllowed($data['meta']['error_message'], $data['meta']['code']);
                break;
            case 200:
            case 201:
                $this->data = $data['data'];
                break;
            default:
                break;
        }
    }

    /**
     * @return array
     */
    protected function getData()
    {
        return $this->data;
    }

    public function getCouriers()
    {
        return new \ParcelGoClient\Response\Couriers($this->getData());
    }

    public function courierDetect()
    {
        return new \ParcelGoClient\Response\CourierDetect($this->getData());
    }

    public function trackingCreate()
    {
        return new \ParcelGoClient\Response\TrackingCreate($this->getData());
    }
}