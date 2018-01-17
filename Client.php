<?php
namespace czPechy\Claymore;

class Client
{

    /** @var string url */
    protected $remote;

    /** @var string downloaded data */
    private $original_json;

    /** @var \stdClass data */
    protected $data;

    public function __construct($remote_address)
    {
        $this->remote = $remote_address;
    }

    /**
     * @return \stdClass
     * @throws ClientException
     */
    public function getData() {
        if(!$this->data) {
            $this->downloadData();
        }
        return $this->data;
    }

    /**
     * @return string
     * @throws ClientException
     */
    public function getJson() {
        if(!$this->data) {
            $this->downloadData();
        }

        return \json_encode($this->data);
    }

    /**
     * @throws ClientException
     */
    private function downloadData() {
        $page_data = @file_get_contents('http://' . $this->remote);
        if(!$page_data) {
            throw new ClientException('Cannot get data from ' + $this->remote);
        }
        if(!preg_match("~\{.+\}~", $page_data, $result)) {
            throw new ClientException('Cannot parse data from ' + $this->remote);
        }
        $this->original_json = @array_pop($result);
        $json = json_decode($this->original_json);
        $keys = ['version', 'runtime', 'eth', 'eth_gpu', 'dcr', 'dcr_gpu', 'temp', 'pool', 'invalid_shares'];
        $miner_data = array_combine($keys, array_values($json->result));

        $this->data = $this->parse($miner_data);
    }

    private function parse($miner_data) {
        $start_time = new \DateTime('-' . $miner_data['runtime'] . ' Minutes');
        list($eth_hashrate, $eth_accepted_shares, $eth_rejected_shares) = explode(';', $miner_data['eth']);
        list($dcr_hashrate, $dcr_accepted_shares, $dcr_rejected_shares) = explode(';', $miner_data['dcr']);

        $data = new \stdClass();
        $data->version = $miner_data['version'];
        $data->runtime = new \stdClass();
        $data->runtime->minutes = $miner_data['runtime'];
        $data->runtime->start = $start_time->format('Y-m-d H:i:s');
        $data->eth = new \stdClass();
        $data->eth->hashrate = $eth_hashrate;
        $data->eth->shares = new \stdClass();
        $data->eth->shares->accepted = $eth_accepted_shares;
        $data->eth->shares->rejected = $eth_rejected_shares;
        $data->drc = new \stdClass();
        $data->drc->hashrate = $dcr_hashrate;
        $data->drc->shares = new \stdClass();
        $data->drc->shares->accepted = $dcr_accepted_shares;
        $data->drc->shares->rejected = $dcr_rejected_shares;
        $data->pool = $miner_data['pool'];
        $data->gpus = [];

        $eth_gpus_hashrate = explode(';', $miner_data['eth_gpu']);
        $dcr_gpus_hashrate = explode(';', $miner_data['dcr_gpu']);
        $gpu_temps = explode(';', $miner_data['temp']);
        foreach($eth_gpus_hashrate as $key => $eth_gpu_hashrate) {
            $data->gpus[] = (object) [
                'title' => 'GPU' . $key,
                'hashrate' => (object) [
                    'eth' => $eth_gpu_hashrate === 'off' ? null : $eth_gpu_hashrate,
                    'dcr' => $dcr_gpus_hashrate[$key] === 'off' ? null : $dcr_gpus_hashrate[$key],
                ],
                'temp' => $gpu_temps[$key],
                'fan' => $gpu_temps[$key+1]
            ];
        }
        return $data;
    }



}

class ClientException extends \Exception {}