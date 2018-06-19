<?php
require_once __DIR__ . '/../vendor/autoload.php';

Tester\Environment::setup();

$htmlData = @file_get_contents(__DIR__ . '/data/data.html');

$data = \czPechy\Claymore\Parser::getJsonFromConsole($htmlData);
\Tester\Assert::type('string', $data);

$json = @json_decode($data);
\Tester\Assert::type('object', $json);

\czPechy\Claymore\Parser::getGPUsFromConsole($htmlData);
\czPechy\Claymore\Parser::getSharesFromConsole($htmlData);