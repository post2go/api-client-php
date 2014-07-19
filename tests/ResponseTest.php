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
        new Response(array('meta' => array('code' => 400, 'error_message' => 'Bad Request')));
    }

    /**
     * @expectedException \ParcelGoClient\Exception\Response\ServerError
     */
    public function testServerErrorCode()
    {
        new Response(array('meta' => array('code' => 500, 'error_message' => 'ServerError')));
    }

    /**
     * @expectedException \ParcelGoClient\Exception\Response\AuthRequired
     */
    public function testAuthRequiredCode()
    {
        new Response(array('meta' => array('code' => 401, 'error_message' => 'AuthRequired')));
    }

    /**
     * @expectedException \ParcelGoClient\Exception\Response\MethodNotAllowed
     */
    public function testMethodNotAllowedCode()
    {
        new Response(array('meta' => array('code' => 405, 'error_message' => 'MethodNotAllowed')));
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
        new Response(array('meta' => array('code' => 459)));
    }

}