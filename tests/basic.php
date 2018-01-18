<?php
require_once __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
$data = @file_get_contents(__DIR__ . '/data.json');
$json_data = @json_decode($data);
$parsed_data = \czPechy\Claymore\Parser::createKeys($json_data->result);

if($parsed_data['version'] !== '10.0 - ETH') {
    echo 'ERROR!' . PHP_EOL;
} else {
    echo 'OK!' . PHP_EOL;
}