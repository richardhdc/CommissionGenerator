<?php

use Lib\Commission;
use PHPUnit\Framework\TestCase;

class CommissionTest extends TestCase
{
    public function testCommission()
    {
        $commission = new Commission('https://lookup.binlist.net/', 'https://api.exchangeratesapi.io/latest');
        $commission->compute("input.txt");
        $this->assertFalse($commission->hasError);
    }

    public function testCommissionInvalidFile()
    {
        $commission = new Commission('https://lookup.binlist.net/', 'https://api.exchangeratesapi.io/latest');
        $commission->compute("noinput.txt");
        $this->assertTrue($commission->hasError);
    }

}