<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class Wildcard extends AbstractBuilder
{
    protected string $apiName = 'wildcard';

    public function queryDsl(): array
    {
        return [
            $this->field => [
                'value' => $this->value,
            ],
        ];
    }
}
