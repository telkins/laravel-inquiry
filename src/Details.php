<?php

namespace Telkins\LaravelInquiry;

use Telkins\LaravelInquiry\Contracts\Details as Contract;

abstract class Details implements Contract
{
    protected $inquiryClass;

    final public function answer()
    {
        return resolve($this->inquiryClass)->answer($this);
    }
}
