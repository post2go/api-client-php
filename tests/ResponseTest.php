<?php
namespace Post2GoClient\Tests;

use Post2GoClient\Response;

class ResponseTest extends Base
{
    /**
     * @expectedException \Post2GoClient\Exception\Response\BadRequest
     */
    public function testBadRequestCode()
    {
        new Response(array('error' => array('code' => -32700, 'message' => 'Bad Request')));
    }

    /**
     * @expectedException \Post2GoClient\Exception\Response\ServerError
     */
    public function testServerErrorCode()
    {
        new Response(array('error' => array('code' => -32603, 'message' => 'ServerError')));
    }

    /**
     * @expectedException \Post2GoClient\Exception\Response\AuthRequired
     */
    public function testAuthRequiredCode()
    {
        new Response(array('error' => array('code' => 401, 'message' => 'AuthRequired')));
    }

    /**
     * @expectedException \Post2GoClient\Exception\Response\MethodNotAllowed
     */
    public function testMethodNotAllowedCode()
    {
        new Response(array('error' => array('code' => -32601, 'message' => 'MethodNotAllowed')));
    }

    /**
     * @expectedException \Post2GoClient\Exception\Response\Base
     */
    public function testMissingMetaCode()
    {
        new Response(array());
    }

    /**
     * @expectedException \Post2GoClient\Exception\Response\Base
     */
    public function testUnknownCode()
    {
        new Response(array('error' => array('code' => 459)));
    }

}