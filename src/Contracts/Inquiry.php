<?php

namespace Telkins\LaravelInquiry\Contracts;

interface Inquiry
{
    public static function ask(): Details;

    public function answer(Details $details);
}
