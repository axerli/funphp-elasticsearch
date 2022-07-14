<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class Term extends AbstractBuilder
{
    protected string $apiName = 'term';

    public function queryDsl(): array
    {
        return [
            $this->field => $this->value,
        ];
    }
}
