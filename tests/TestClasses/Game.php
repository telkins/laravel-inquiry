<?php

namespace Telkins\LaravelInquiry\Tests\TestClasses;

use Telkins\LaravelInquiry\Details;

class Game
{
    public $name;
    public $scoring;

    public function __construct(string $name, string $scoring)
    {
        $this->name = $name;
        $this->scoring = $scoring;
    }
}