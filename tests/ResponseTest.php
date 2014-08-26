<?php
namespace ParcelGoClient\Tests;

use ParcelGoClient\Response;

class ResponseTest extends Base
{
    /**
     * @expectedException \ParcelGoClient\Exception\Response\BadRequest
     */
    public function testBadRequestCode()
    {
        new Response(array('error' => array('code' => -32700, 'message' => 'Bad Request')));
    }

    /**
     * @expectedException \ParcelGoClient\Exception\Response\ServerError
     */
    public function testServerErrorCode()
    {
        new Response(array('error' => array('code' => -32603, 'message' => 'ServerError')));
    }

    /**
     * @expectedException \ParcelGoClient\Exception\Response\AuthRequired
     */
    public function testAuthRequiredCode()
    {
        new Response(array('error' => array('code' => 401, 'message' => 'AuthRequired')));
    }

    /**
     * @expectedException \ParcelGoClient\Exception\Response\MethodNotAllowed
     */
    public function testMethodNotAllowedCode()
    {
        new Response(array('error' => array('code' => -32601, 'message' => 'MethodNotAllowed')));
    }

    /**
     * @expectedException \ParcelGoClient\Exception\Response\Base
     */
    public function testMissingMetaCode()
    {
        new Response(array());
    }

    /**
     * @expectedException \ParcelGoClient\Exception\Response\Base
     */
    public function testUnknownCode()
    {
        new Response(array('error' => array('code' => 459)));
    }

}