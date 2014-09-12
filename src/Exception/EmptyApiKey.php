<?php
namespace Post2GoClient\Exception;

class EmptyApiKey extends Base
{
    protected $message = 'Api key cannot be empty';
}