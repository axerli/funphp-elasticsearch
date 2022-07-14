<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Client;

use Elasticsearch\Client as ElasticsearchClient;
use Elasticsearch\ClientBuilder;

class Connection
{
    /**
     * @var ElasticsearchClient|null $elastic
     */
    protected static ?ElasticsearchClient $elastic = null;

    /**
     * @return ElasticsearchClient
     */
    public function create(): ElasticsearchClient
    {
        if (self::$elastic instanceof ElasticsearchClient) {
            return self::$elastic;
        }

        self::$elastic = ClientBuilder::create()
            ->setHosts($this->getHosts())
            ->build();

        return self::$elastic;
    }

    /**
     * @return array
     */
    public function getHosts(): array
    {
        return (array) config('funphp.elasticsearch.hosts', $this->defaultHosts());
    }

    private function defaultHosts(): array
    {
        return [
            [
                'host'   => '127.0.0.1',
                'port'   => '9200',
                'scheme' => 'http',
            ],
        ];
    }
}
