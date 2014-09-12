<?php
namespace Post2GoClient\Exception;

class EmptySlug extends Base
{
    protected $message = 'Slug cannot be empty';
}