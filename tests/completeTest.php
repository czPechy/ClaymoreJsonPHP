<?php
require_once __DIR__ . '/../vendor/autoload.php';

class completeTest extends PHPUnit_Framework_TestCase
{

    public function testParse()
    {

        $client = new \czPechy\Claymore\Client( '84.242.85.123:24833' );
        $data = $client->getData();
        $json = $client->getJson();

        $this->assertInternalType( 'object', $data );
        $this->assertInternalType( 'string', $json );

        $this->assertSame( 'GeForce GTX 1070 Ti, 8192 MB available, 19 compute units, capability: 6.1', $data->gpus[ 0 ]->name );
        $this->assertSame( 'GeForce GTX 1070 Ti, 8192 MB available, 19 compute units, capability: 6.1', $data->gpus[ 1 ]->name );
        $this->assertSame( 'GeForce GTX 1070 Ti, 8192 MB available, 19 compute units, capability: 6.1', $data->gpus[ 2 ]->name );

    }

}
