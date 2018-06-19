<?php
require_once __DIR__ . '/../vendor/autoload.php';

class htmlTest extends PHPUnit_Framework_TestCase
{

    public function testParse()
    {

        $htmlData = @file_get_contents( __DIR__ . '/data/data.html' );

        $data = \czPechy\Claymore\Parser::getJsonFromConsole( $htmlData );
        $this->assertInternalType( 'string', $data );

        $json = @json_decode( $data );
        $this->assertInternalType( 'object', $json );

        \czPechy\Claymore\Parser::getGPUsFromConsole( $htmlData );
        \czPechy\Claymore\Parser::getSharesFromConsole( $htmlData );

    }

}
