<?php

require_once __DIR__ . '/CsvToArray.php';

$file = __DIR__ . '/fichiers/Connections.csv';
$csv = new CsvToArray($file);
$tableau = $csv->convert();
$response = $csv->organnigramme($tableau);


var_dump($response);