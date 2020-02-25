<?php

namespace Telkins\LaravelInquiry;

use Telkins\LaravelInquiry\Contracts\Details as Contract;

abstract class Details implements Contract
{
    protected $questionClass;

    final public function answer()
    {
        return resolve($this->questionClass)->answer($this);
    }
}
