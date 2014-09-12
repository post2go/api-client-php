<?php
namespace Post2GoClient;

use Post2GoClient\Core\Request;

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
     * @return \Post2GoClient\Core\Request
     */
    protected function getRequest()
    {
        return $this->request;
    }
}