<?php
namespace ParcelGoClient;

use ParcelGoClient\Core\Request;
use ParcelGoClient\Exception\EmptyRequest;
use ParcelGoClient\Exception\EmptySlug;
use ParcelGoClient\Exception\EmptyTrackingNumber;

class Tracking
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create(array $data)
    {
        if (empty($data)) {
            throw new EmptyRequest;
        }

        $result = $this->request->send('trackings', 'POST', json_encode(array('tracking' => $data)));

        if ($result['meta']['code'] == 200 || $result['meta']['code'] == 201) {
            return $result['data']['tracking'];
        } else {
            return false;
        }
    }

    public function get($slug, $trackingNumber, array $fields = array())
    {
        if (empty($slug)) {
            throw new EmptySlug;
        }

        if (empty($trackingNumber)) {
            throw new EmptyTrackingNumber;
        }

        return $this->request->send('trackings/' . $slug . '/' . $trackingNumber, 'GET', $fields);
    }

}
