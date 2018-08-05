<?php
require_once __DIR__ . '/../vendor/autoload.php';

class exceptionTest extends PHPUnit_Framework_TestCase
{

    public function testGetJsonFromConsoleException()
    {
        try {
            \czPechy\Claymore\Parser::getJsonFromConsole( '' );
        } catch (\czPechy\Claymore\ParserException $pe) {
            $this->throwException($pe);
        }
    }

    public function testGetSharesFromConsoleException()
    {
        try {
            \czPechy\Claymore\Parser::getSharesFromConsole( '' );
        } catch (\czPechy\Claymore\ParserException $pe) {
            $this->throwException($pe);
        }
    }

    public function testGetGPUsFromConsoleException()
    {
        try {
            \czPechy\Claymore\Parser::getGPUsFromConsole( '' );
        } catch (\czPechy\Claymore\ParserException $pe) {
            $this->throwException($pe);
        }
    }

    public function testDownloadDataException()
    {
        try {
            $client = new \czPechy\Claymore\Client('http://some-bad-ip:3333');
            $client->getJson();
        } catch (\czPechy\Claymore\ClientException $ce) {
            $this->throwException($ce);
        }
    }

}
