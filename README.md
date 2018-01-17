# ClaymoreJsonPHP
Get JSON stats from Claymore Dual Miner

# Usage
```php
require_once 'Client.php';

$host = 'ip_address:3333';
$client = new \czPechy\Claymore\Client($host);

echo $client->getJson(); // or $client->getData() for object
```

# Result
```json
{
  "version":"10.0 - ETH",
  "runtime": {
    "minutes":"1332",
    "start":"2018-01-16 20:49:41"
  },
  "eth": {
    "hashrate":"115156",
    "shares":{
      "accepted":"873",
      "rejected":"0"
    }
  },
  "drc": {
    "hashrate":"0",
    "shares": {
      "accepted":"0",
      "rejected":"0"
    }
  },
  "pool": "eth-eu1.nanopool.org:9999",
  "gpus": [
    {
      "title":"GPU0",
      "hashrate": {
        "eth":"28735",
        "dcr":null
      },
      "temp":"66",
      "fan":"77"
    },
    {
      "title":"GPU1",
      "hashrate":{
        "eth": "28814",
        "dcr":null
      },
      "temp":"77",
      "fan":"60"
    },
    {
      "title":"GPU2",
      "hashrate":
      {
        "eth":"28816",
        "dcr":null
      },
      "temp":"60",
      "fan":"71"
    },
    {
      "title":"GPU3",
      "hashrate": {
        "eth":"28790",
        "dcr":null
      },
      "temp":"71",
      "fan":"45"
    }
  ]
}
```



