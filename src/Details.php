<?php

namespace Telkins\LaravelInquiry;

use Telkins\LaravelInquiry\Contracts\Details as Contract;

abstract class Details implements Contract
{
    private $inquiryClass;

    final public function inquiryClass(string $inquiryClass): self
    {
        $this->inquiryClass = $inquiryClass;

        return $this;
    }

    final public function answer()
    {
        return resolve($this->inquiryClass)->answer($this);
    }
}
