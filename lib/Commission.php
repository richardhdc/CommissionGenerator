<?php

namespace Lib;

use Exception;
use Lib\Entity\Eu;
use Lib\Entity\NonEu;
use Lib\Service\FileReader;

class Commission
{
    public $print = '';
    public $binProvider;
    public $currencyProvider;
    public $isEu = false;
    public $hasError = false;
    public $rate = 0;

    public function __construct($binUrl, $currencyUrl)
    {
        $this->binProvider = $binUrl;
        $this->currencyProvider = $currencyUrl;
    }

    public function compute($filePath)
    {
        $fileReader = new FileReader;
        $fileReader->read($filePath);
        if ($fileReader->hasContent()) {
            $transactions = $fileReader->getDataArray();
            foreach ($transactions as $transaction) {
                if (empty($transaction)) {
                    break;
                }
                $data = json_decode($transaction);

                $this->bin($data->bin);
                if ($this->hasError) {
                    return;
                }
                $this->currency($data->currency);
                $this->createView($data);
            }
            return;
        }
        $this->hasError = true;
        $this->print = "There is a problem in the File!";
    }

    public function view()
    {
        return $this->print;
    }

    private function bin($bin)
    {
        $fileReader = new FileReader;
        $fileReader->read($this->binProvider . $bin);

        if ($fileReader->hasContent()) {
            $data = $fileReader->getDataJsonDecoded();
            $entity = new Eu;
            $this->isEu = $entity->isCountryEu($data->country->alpha2);
            return;
        }
        $this->hasError = true;
        $this->print = "There is a problem in the Bin Provider!";
    }

    private function currency($currency)
    {
        $fileReader = new FileReader;
        $fileReader->read($this->currencyProvider);

        if ($fileReader->hasContent()) {
            $data = $fileReader->getDataJsonDecoded();
            $this->rate = $data->rates->$currency ?? 0;
            return;
        }
        $this->hasError = true;
        $this->print = "There is a problem in the Currency Provider!";
    }

    private function createView($data)
    {
        if ($data->currency == 'EUR' || $this->rate == 0) {
            $entity = new Eu();
        }
        if ($data->currency != 'EUR' || $this->rate > 0) {
            $entity = new NonEu($this->rate);
        }
        $this->print .= $entity->commission($data->amount) . "\n";
    }

}