<?php
require_once 'Client.php';

$host = 'ip_address:3333';
$client = new \czPechy\Claymore\Client($host);

echo $client->getJson();