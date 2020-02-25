<?php

namespace Telkins\LaravelInquiry;

use Telkins\LaravelInquiry\Contracts\Details;
use Telkins\LaravelInquiry\Contracts\Question as Contract;

abstract class Question implements Contract
{
    protected static $detailsClass;

    final public static function ask(): Details
    {
        return (new static::$detailsClass);
    }
}
