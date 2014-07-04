<?php
namespace ParcelGoClient\Exception;

class EmptyApiKey extends Base
{
    protected $message = 'Api key cannot be empty';
}