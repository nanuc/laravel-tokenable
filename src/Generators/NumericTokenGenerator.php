<?php

namespace Nanuc\LaravelTokenable\Generators;

class NumericTokenGenerator extends BaseTokenGenerator
{
    protected $length;

    public function __construct($length = 4)
    {
        $this->length = $length;
    }

    protected function generate()
    {
        $start = 10 ** ($this->length - 1);
        $end = 10 * $start - 1;

        return rand($start, $end);
    }
}