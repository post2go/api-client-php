<?php
namespace Post2GoClient\Exception;

class EmptyRequest extends Base
{
    protected $message = 'Request cannot be empty';
}