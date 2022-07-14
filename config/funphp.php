<?php

declare(strict_types = 1);

return [
    'elasticsearch' => [
        'hosts' => value(function () {
            $settings = env('ELASTICSEARCH_HOSTS');
            $hosts    = array_filter(explode(';', $settings));
            return $hosts ? array_map(function ($url) {
                return array_merge(parse_url($url), [
                    'user' => env('ELASTICSEARCH_USER', null),
                    'pass' => env('ELASTICSEARCH_PASS', null),
                ]);
            }, $hosts) : [
                [
                    'host'   => '127.0.0.1',
                    'port'   => '9200',
                    'scheme' => 'http',
                    'user'   => env('ELASTICSEARCH_USER', null),
                    'pass'   => env('ELASTICSEARCH_PASS', null),
                ],
            ];
        }),
    ],
];
