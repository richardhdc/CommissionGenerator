<?php

namespace Lib\Entity;

class NonEu
{
    public $rate;

    public function __construct($rate)
    {
        $this->rate = $rate;
    }

    public function commission($amount)
    {
        return round((($amount / $this->rate) * 0.02), 2);
    }

}