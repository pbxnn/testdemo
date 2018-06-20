<?php

$conf = [
    'balancer.enable' => true,
    'balancer.upstreams' => [
        'test.local.com' => [
            'enable' => true,
            'type' => 0,
            'hashvar' => 0,
            'keepalive' => 100,
            'servers' => [
                ['ip' => '127.0.0.1:9000', 'enable' => true, 'weight' => 1, 'is_backup' => false],
                ['ip' => '127.0.0.1:9001', 'enable' => true, 'weight' => 10, 'is_backup' => false],
                ['ip' => '127.0.0.1:9002', 'enable' => true, 'weight' => 100, 'is_backup' => true],
            ]
        ],
        'test.balancer.com' => [
            'enable' => true,
            'type' => 1,
            'hashvar' => 0,
            'keepalive' => 32,
            'servers' => [
                ['ip' => '127.0.0.1:9003', 'enable' => true, 'weight' => 1, 'is_backup' => false],
                ['ip' => '127.0.0.1:9004', 'enable' => true, 'weight' => 10, 'is_backup' => false],
                ['ip' => '127.0.0.1:9005', 'enable' => true, 'weight' => 100, 'is_backup' => true],
            ],
        ],
        'test.xesv5.com' => [
            'enable' => true,
            'type' => 1,
            'hashvar' => 1,
            'keepalive' => 0,
            'servers' => [
                ['ip' => '127.0.0.1:9006', 'enable' => true, 'weight' => 1, 'is_backup' => false],
                ['ip' => '127.0.0.1:9007', 'enable' => true, 'weight' => 10, 'is_backup' => false],
                ['ip' => '127.0.0.1:9008', 'enable' => true, 'weight' => 100, 'is_backup' => true],
            ],
        ],
    ]
];

$json = json_encode($conf);
file_put_contents('/tmp/conf.json', $json);
exit;

//echo $json . PHP_EOL;

$upstreams = json2ups($json);
echo $upstreams . PHP_EOL;


function json2ups ($json)
{
    $conf = json_decode($json, true);
    $res = '';
    if (!$conf || !is_array($conf)) {
        echo 'decode json error' . PHP_EOL;
        exit(1);
    }

    if (empty($conf['balancer.upstreams'])) {
        echo 'empty upstreams' . PHP_EOL;
        exit(1);
    }

    $upstreams = $conf['balancer.upstreams'];
    foreach ($upstreams as $name => $options) {
        if (!$options['enable']) {
            continue;
        }

        $res .= 'upstream ' . $name . ' {' . PHP_EOL;
        if ($options['type'] == 1) {
            if ($options['hashvar'] == 0) {
                $res .= '    hash $hash_uri consistent' . PHP_EOL;
            }
            if ($options['hashvar'] == 1) {
                $res .= '    hash $remote_addr consistent' . PHP_EOL;
            }
        }

        if ($options['keepalive'] != 0) {
            $res .= '    keepalive ' . $options['keepalive'] . PHP_EOL;
        }

        $res .= PHP_EOL;

        foreach ($options['servers'] as $k => $serv) {
            if ($serv['enable'] != true) {
                continue;
            }

            $res .= '    server ' . $serv['ip'];
            if ($serv['weight'] != 1) {
                $res .= ' ' . $serv['weight'];
            }
            if ($serv['is_backup'] == true) {
                $res .= ' backup';
            }
            $res .= ';' . PHP_EOL;
        }
        $res .= '}' . PHP_EOL . PHP_EOL . PHP_EOL;
    }

    return $res;
}
