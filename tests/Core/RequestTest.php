<?php
namespace ParcelGoClient\Tests;

use ParcelGoClient\Core\Request;

class RequestTest extends Base
{

    /**
     * @expectedException \ParcelGoClient\Exception\EmptyApiKey
     * @throws \ParcelGoClient\Exception\EmptyApiKey
     */
    public function testConstructEmptyApiKey()
    {
        new Request('');
    }


}