<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Sort;

use Funphp\Elasticsearch\Search\Script\Script;

class SortScript extends Script
{
    protected string $apiName = '_script';

    private string $type;

    private string $order;

    public function __construct(string $type, string $order = 'asc')
    {
        parent::__construct();

        $this->type  = $type;
        $this->order = $order;
    }


    public function queryDsl(): array
    {
        return [
            'type'   => $this->type,
            'order'  => $this->order,
            'script' => [
                'lang'   => $this->lang,
                'source' => $this->source,
                'params' => (object) $this->params,
            ],
        ];
    }
}
