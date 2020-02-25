<?php

namespace Telkins\LaravelInquiry\Contracts;

interface Question
{
    public static function ask(): Details;

    public function answer(Details $details);
}
