<?php

namespace czPechy\Claymore;

class Client
{

    /** @var string url */
    protected $remote;

    /** @var string downloaded data */
    private $original_json;

    /** @var array */
    private $gpus;

    /** @var array */
    private $shares;

    /** @var \stdClass data */
    protected $data;

    public function __construct( $remote_address )
    {
        $this->remote = $remote_address;
    }

    /**
     * @return \stdClass
     * @throws ClientException
     * @throws ParserException
     */
    public function getData()
    {
        if ( !$this->data ) {
            $this->downloadData();
        }
        return $this->data;
    }

    /**
     * @return string
     * @throws ClientException
     * @throws ParserException
     */
    public function getJson()
    {
        if ( !$this->data ) {
            $this->downloadData();
        }

        return \json_encode( $this->data );
    }

    /**
     * @throws ClientException
     * @throws ParserException
     */
    private function downloadData()
    {
        $page_data = @file_get_contents( 'http://' . $this->remote );
        if ( !$page_data ) {
            throw new ClientException( 'Cannot get data from ' . $this->remote );
        }

        $this->original_json = Parser::getJsonFromConsole( $page_data );
        try {
            $this->gpus = Parser::getGPUsFromConsole( $page_data );
            $this->shares = Parser::getSharesFromConsole( $page_data );
        } catch ( ParserException $e ) {

        }

        if ( !$json = @json_decode( $this->original_json ) ) {
            throw new ClientException( 'Cannot parse JSON' );
        }

        $miner_data = Parser::createKeys( $json->result );
        $this->data = Parser::convertStructure( $miner_data );
        $this->combineData();
    }

    private function combineData()
    {
        if ( $this->gpus ) {
            foreach ( $this->gpus as $key => $name ) {
                if ( isset( $this->data->gpus[ $key ] ) ) {
                    $this->data->gpus[ $key ]->name = $name;
                }
            }
        }
        if ( $this->shares ) {
            foreach ( $this->shares[ 'gpu' ] as $key => $sharesCount ) {
                if ( isset( $this->data->gpus[ $key ] ) ) {
                    $this->data->gpus[ $key ]->shares = $sharesCount;
                }
            }
        }
    }

}
