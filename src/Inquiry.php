<?php

namespace Telkins\LaravelInquiry;

use InvalidArgumentException;
use Telkins\LaravelInquiry\Contracts\Details;
use Telkins\LaravelInquiry\Contracts\Inquiry as Contract;

abstract class Inquiry implements Contract
{
    protected static $detailsClass;

    final public static function ask(): Details
    {
        $detailsClass = self::getDetailsClass();

        return (new $detailsClass)->inquiryClass(static::class);
    }

    private static function getDetailsClass()
    {
        if (static::$detailsClass) {
            return static::$detailsClass;
        }

        return static::class . 'Details';
    }

    final public function answer(Details $details)
    {
        $this->guardAgainstBadDetails($details);

        return $this->provideAnswer($details);
    }

    private function guardAgainstBadDetails($details)
    {
        $detailsClass = self::getDetailsClass();

        if (! $details instanceof $detailsClass) {
            throw new InvalidArgumentException();
        }
    }

    abstract protected function provideAnswer(Details $details);
}
