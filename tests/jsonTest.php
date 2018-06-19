<?php
require_once __DIR__ . '/../vendor/autoload.php';

class json extends PHPUnit_Framework_TestCase
{

    public function testParse()
    {
        $data = @file_get_contents( __DIR__ . '/data/data.json' );
        $this->assertInternalType( 'string', $data );

        $json_data = @json_decode( $data );
        $this->assertInternalType( 'object', $json_data );

        $parsed_data = \czPechy\Claymore\Parser::createKeys( $json_data->result );
        $this->assertInternalType( 'array', $parsed_data );

        $this->assertSame( '10.0 - ETH', $parsed_data[ 'version' ] );

        $structured_data = \czPechy\Claymore\Parser::convertStructure( $parsed_data );

        $this->assertCount( 3, $structured_data->gpus );
        $this->assertSame( 56, $structured_data->gpus[ 1 ]->temp );
        $this->assertSame( 87639, $structured_data->eth->hashrate );
        $this->assertSame( 0, $structured_data->dcr->hashrate );
    }

}
