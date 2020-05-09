<?php

namespace Lib\Entity;

class Eu
{
    private $countries = [
        'AT',
        'BE',
        'BG',
        'CY',
        'CZ',
        'DE',
        'DK',
        'EE',
        'ES',
        'FI',
        'FR',
        'GR',
        'HR',
        'HU',
        'IE',
        'IT',
        'LT',
        'LU',
        'LV',
        'MT',
        'NL',
        'PO',
        'PT',
        'RO',
        'SE',
        'SI',
        'SK',
    ];
    private $isEu = false;

    public function isCountryEu($country)
    {
        $this->isEu = in_array($country, $this->countries);
        return $this->isEu;
    }

    public function getYesOrNo()
    {
        return $this->isEu ? "yes" : "no";
    }

    public function commission($amount)
    {
        return round(($amount * 0.01), 2);
    }

}