<?php
namespace Post2GoClient;

use Post2GoClient\Exception\Response\AccessDenied;
use Post2GoClient\Exception\Response\AuthRequired;
use Post2GoClient\Exception\Response\BadRequest;
use Post2GoClient\Exception\Response\Base as BaseException;
use Post2GoClient\Exception\Response\MethodNotAllowed;
use Post2GoClient\Exception\Response\ServerError;

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
                case -32700:
                case -32600:
                case -32602:
                    throw new BadRequest($data['error']['message'], $data['error']['code']);
                    break;
                case -32601:
                    throw new MethodNotAllowed($data['error']['message'], $data['error']['code']);
                    break;
                case -32603:
                    throw new ServerError($data['error']['message'], $data['error']['code']);
                    break;
                case 401:
                    throw new AuthRequired($data['error']['message'], $data['error']['code']);
                    break;
                case 403:
                    throw new AccessDenied($data['error']['message'], $data['error']['code']);
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
     * @return Response\TrackingSimple
     */
    public function trackingCreate()
    {
        return new Response\TrackingSimple($this->getData());
    }

    /**
     * @return Response\TrackingSimple
     */
    public function trackingEdit()
    {
        return new Response\TrackingSimple($this->getData());
    }

    /**
     * @return Response\TrackingSimple
     */
    public function trackingDelete()
    {
        return new Response\TrackingSimple($this->getData());
    }

    /**
     * @return Response\Tracking
     */
    public function tracking()
    {
        return new Response\Tracking($this->getData());
    }

    /**
     * @return Response\TrackingSimple
     */
    public function trackingReactivate()
    {
        return new Response\TrackingSimple($this->getData());
    }

    /**
     * @return Response\LastCheckPoint
     */
    public function lastCheckPoint()
    {
        return new Response\LastCheckPoint($this->getData());
    }
}