<?php
require_once __DIR__ . '/../vendor/autoload.php';

Tester\Environment::setup();

$client = new \czPechy\Claymore\Client('home.pecha.pro:3333');
$data = $client->getData();
$json = $client->getJson();

\Tester\Assert::type('object', $data);
\Tester\Assert::type('string', $json);

\Tester\Assert::same('GeForce GTX 1070 Ti, 8192 MB available, 19 compute units, capability: 6.1', $data->gpus[0]->name);
\Tester\Assert::same('GeForce GTX 1070 Ti, 8192 MB available, 19 compute units, capability: 6.1', $data->gpus[1]->name);
\Tester\Assert::same('GeForce GTX 1070 Ti, 8192 MB available, 19 compute units, capability: 6.1', $data->gpus[2]->name);