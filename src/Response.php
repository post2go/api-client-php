<?php
namespace ParcelGoClient;

use ParcelGoClient\Exception\Response\AuthRequired;
use ParcelGoClient\Exception\Response\BadRequest;
use ParcelGoClient\Exception\Response\Base as BaseException;
use ParcelGoClient\Exception\Response\MethodNotAllowed;
use ParcelGoClient\Exception\Response\ServerError;
use ParcelGoClient\Response\CourierDetect;
use ParcelGoClient\Response\LastCheckPoint;
use ParcelGoClient\Response\Tracking;
use ParcelGoClient\Response\TrackingCreate;
use ParcelGoClient\Response\TrackingReactivate;

class Response
{
    /**
     * @var array
     */
    private $data;

    public function __construct($data)
    {
        if (!array_key_exists('meta', $data)) {
            throw new BaseException('Missing meta key in response');
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
               throw new BaseException('Unknown response code');
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
        return new \ParcelGoClient\Response\Couriers($this->getData());
    }

    /**
     * @return Response\CourierDetect
     */
    public function courierDetect()
    {
        return new CourierDetect($this->getData());
    }

    /**
     * @return Response\TrackingCreate
     */
    public function trackingCreate()
    {
        return new TrackingCreate($this->getData());
    }

    /**
     * @return Response\Tracking
     */
    public function tracking()
    {
        return new Tracking($this->getData());
    }

    /**
     * @return Response\TrackingReactivate
     */
    public function trackingReactivate()
    {
        return new TrackingReactivate($this->getData());
    }

    /**
     * @return LastCheckPoint
     */
    public function lastCheckPoint()
    {
        return new LastCheckPoint($this->getData());
    }
}