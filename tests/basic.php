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

$structured_data = \czPechy\Claymore\Parser::convertStructure($parsed_data);

if(count($structured_data->gpus) !== 3) {
    echo 'ERROR!' . PHP_EOL;
} else {
    echo 'OK!' . PHP_EOL;
}

if($structured_data->gpus[1]->temp !== 56) {
    echo 'ERROR!' . PHP_EOL;
} else {
    echo 'OK!' . PHP_EOL;
}

if($structured_data->eth->hashrate !== 87639) {
    echo 'ERROR!' . PHP_EOL;
} else {
    echo 'OK!' . PHP_EOL;
}

if($structured_data->dcr->hashrate !== 0) {
    echo 'ERROR!' . PHP_EOL;
} else {
    echo 'OK!' . PHP_EOL;
}