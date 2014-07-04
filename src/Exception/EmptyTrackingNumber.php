<?php
namespace ParcelGoClient\Exception;

class EmptyTrackingNumber extends Base
{
    protected $message = 'Tracking number cannot be empty';
}