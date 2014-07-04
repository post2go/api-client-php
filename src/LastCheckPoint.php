<?php
namespace ParcelGoClient;

use ParcelGoClient\Core\Request;
use ParcelGoClient\Exception\EmptySlug;
use ParcelGoClient\Exception\EmptyTrackingNumber;

class LastCheckPoint
{
    /**
     * @var Core\Request
     */
    private $request;

    public function __construct(Request $request)
    {
       $this->request = $request;
    }

    /**
     * Return the tracking information of the last checkpoint of a single tracking.
     *
     * @param $slug
     * @param $trackingNumber
     *
     * @throws Exception\EmptySlug
     * @throws Exception\EmptyTrackingNumber
     * @return mixed
     */
    public function get($slug, $trackingNumber)
    {
        if (empty($slug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        return  $this->request->send('last-checkpoint/' . $slug . '/' . $trackingNumber, 'GET');
    }
} 