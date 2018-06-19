[![GitHub version](https://badge.fury.io/gh/czPechy%2FClaymoreJsonPHP.svg)](http://badge.fury.io/gh/czPechy%2FClaymoreJsonPHP)
[![codecov.io](https://codecov.io/github/czPechy/ClaymoreJsonPHP/coverage.svg?branch=master)](https://codecov.io/github/czPechy/ClaymoreJsonPHP?branch=master)

# ClaymoreJsonPHP
Get JSON stats from Claymore Dual Miner

# Install with composer
```sh
$ composer require czpechy/claymore-api
```

# How to use
```php
$host = '192.168.1.1:3333'; // IP address & port for your miner (black console claymore response)
$client = new \czPechy\Claymore\Client($host);

echo $client->getJson(); // or $client->getData() for object
```

# Result
```json
{
  "version": "10.0 - ETH",
  "runtime": {
    "minutes": 1332,
    "start": "2018-01-16 20:49:41"
  },
  "eth": {
    "hashrate": 115156,
    "shares": {
      "accepted": 873,
      "rejected": 0
    }
  },
  "dcr": {
    "hashrate": 0,
    "shares": {
      "accepted": 0,
      "rejected": 0
    }
  },
  "pool": "eth-eu1.nanopool.org:9999",
  "gpus": [
    {
      "title":"GPU0",
      "name":"GeForce GTX 1070 Ti, 8192 MB available, 19 compute units, capability: 6.1",
      "hashrate": {
        "eth": 28735,
        "dcr": null
      },
      "temp": 66,
      "fan": 77,
      "shares": 30
    },
    {
      "title": "GPU1",
      "name":"GeForce GTX 1070 Ti, 8192 MB available, 19 compute units, capability: 6.1",
      "hashrate": {
        "eth": 28814,
        "dcr": null
      },
      "temp": 77,
      "fan": 60,
      "shares": 30
    },
    {
      "title": "GPU2",
      "name":"GeForce GTX 1070 Ti, 8192 MB available, 19 compute units, capability: 6.1",
      "hashrate": {
        "eth": 28816,
        "dcr": null
      },
      "temp": 60,
      "fan": 71,
      "shares": 30
    },
    {
      "title": "GPU3",
      "name":"GeForce GTX 1070 Ti, 8192 MB available, 19 compute units, capability: 6.1",
      "hashrate": {
        "eth": 28790,
        "dcr": null
      },
      "temp": 71,
      "fan": 45,
      "shares": 30
    }
  ]
}
```

# Donate me <3
```
ETH: 0x7D771A56735500f76af15F589155BDC91613D4aB
UBIQ: 0xAC08C7B9F06EFb42a603d7222c359e0fF54e0a13
```

