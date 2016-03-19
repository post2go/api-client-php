<?php
namespace Post2GoClient\Tests;

use Post2GoClient\Core\Request;

class RequestTest extends Base
{

    /**
     * @expectedException \Post2GoClient\Exception\EmptyApiKey
     * @throws \Post2GoClient\Exception\EmptyApiKey
     */
    public function testConstructEmptyApiKey()
    {
        new Request('');
    }
}
