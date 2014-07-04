<?php
namespace ParcelGoClient\Exception;

class EmptyRequest extends Base
{
    protected $message = 'Request cannot be empty';
}