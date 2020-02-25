<?php

namespace Telkins\LaravelInquiry;

use Telkins\LaravelInquiry\Contracts\Details;
use Telkins\LaravelInquiry\Contracts\Inquiry as Contract;

abstract class Inquiry implements Contract
{
    protected static $detailsClass;

    final public static function ask(): Details
    {
        return (new static::$detailsClass);
    }
}
