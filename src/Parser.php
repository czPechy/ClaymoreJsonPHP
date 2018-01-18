<?php
namespace czPechy\Claymore;

class Parser
{

    /**
     * @param string $consoleOutput
     * @return mixed
     * @throws ParserException
     */
    public static function getJsonFromConsole($consoleOutput) {
        if(!preg_match("~\{.+\}~", $consoleOutput, $result)) {
            throw new ParserException('Cannot parse data from Claymore Console');
        }
        return @array_pop($result);
    }

    /**
     * @param array $data
     * @return array
     */
    public static function createKeys($data) {
        $keys = ['version', 'runtime', 'eth', 'eth_gpu', 'dcr', 'dcr_gpu', 'temp', 'pool', 'invalid_shares'];
        return array_combine($keys, array_values($data));
    }

    /**
     * @param array $miner_data
     * @return \stdClass
     */
    public static function convertStructure($miner_data) {
        $start_time = new \DateTime('-' . $miner_data['runtime'] . ' Minutes');
        list($eth_hashrate, $eth_accepted_shares, $eth_rejected_shares) = explode(';', $miner_data['eth']);
        list($dcr_hashrate, $dcr_accepted_shares, $dcr_rejected_shares) = explode(';', $miner_data['dcr']);

        $data = new \stdClass();
        $data->version = $miner_data['version'];
        $data->runtime = new \stdClass();
        $data->runtime->minutes = (int) $miner_data['runtime'];
        $data->runtime->start = $start_time->format('Y-m-d H:i:s');
        $data->eth = new \stdClass();
        $data->eth->hashrate = (int) $eth_hashrate;
        $data->eth->shares = new \stdClass();
        $data->eth->shares->accepted = (int) $eth_accepted_shares;
        $data->eth->shares->rejected = (int) $eth_rejected_shares;
        $data->dcr = new \stdClass();
        $data->dcr->hashrate = (int) $dcr_hashrate;
        $data->dcr->shares = new \stdClass();
        $data->dcr->shares->accepted = (int) $dcr_accepted_shares;
        $data->dcr->shares->rejected = (int) $dcr_rejected_shares;
        $data->pool = $miner_data['pool'];
        $data->gpus = [];

        $eth_gpus_hashrate = explode(';', $miner_data['eth_gpu']);
        $dcr_gpus_hashrate = explode(';', $miner_data['dcr_gpu']);
        $gpu_temps = explode(';', $miner_data['temp']);
        foreach($eth_gpus_hashrate as $key => $eth_gpu_hashrate) {
            $data->gpus[] = (object) [
                'title' => 'GPU' . $key,
                'hashrate' => (object) [
                    'eth' => $eth_gpu_hashrate === 'off' ? null : (int) $eth_gpu_hashrate,
                    'dcr' => $dcr_gpus_hashrate[$key] === 'off' ? null : (int) $dcr_gpus_hashrate[$key],
                ],
                'temp' => (int) $gpu_temps[$key*2],
                'fan' => (int) $gpu_temps[($key*2)+1]
            ];
        }
        return $data;
    }

}