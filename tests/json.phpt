<?php
require_once __DIR__ . '/../vendor/autoload.php';

Tester\Environment::setup();

$data = @file_get_contents(__DIR__ . '/data/data.json');
\Tester\Assert::type('string', $data);

$json_data = @json_decode($data);
\Tester\Assert::type('object', $json_data);

$parsed_data = \czPechy\Claymore\Parser::createKeys($json_data->result);
\Tester\Assert::type('array', $parsed_data);

\Tester\Assert::same('10.0 - ETH', $parsed_data['version']);

$structured_data = \czPechy\Claymore\Parser::convertStructure($parsed_data);

\Tester\Assert::count( 3, $structured_data->gpus);
\Tester\Assert::same(56, $structured_data->gpus[1]->temp);
\Tester\Assert::same(87639, $structured_data->eth->hashrate);
\Tester\Assert::same(0, $structured_data->dcr->hashrate);
