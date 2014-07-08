<?php
namespace ParcelGoClient;

use ParcelGoClient\Core\Request;

abstract class Base
{
    protected $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \ParcelGoClient\Core\Request
     */
    protected function getRequest()
    {
        return $this->request;
    }
}