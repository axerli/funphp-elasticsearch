<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class Terms extends AbstractBuilder
{
    protected string $apiName = 'terms';

    public function queryDsl(): array
    {
        return [
            $this->field => (array) $this->value,
        ];
    }
}
