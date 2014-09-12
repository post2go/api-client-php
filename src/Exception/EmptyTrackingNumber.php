<?php
namespace Post2GoClient\Exception;

class EmptyTrackingNumber extends Base
{
    protected $message = 'Tracking number cannot be empty';
}