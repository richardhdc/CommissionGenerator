<?php

require 'vendor/autoload.php';

use Lib\Commission;

$commission = new Commission('https://lookup.binlist.net/', 'https://api.exchangeratesapi.io/latest');
$commission->compute($argv[1]);
$print = $commission->view();
var_dump($print);



