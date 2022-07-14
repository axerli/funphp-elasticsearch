<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class Exists extends AbstractBuilder
{
    protected string $apiName = 'exists';

    public function queryDsl(): array
    {
        return [
            'field' => $this->field,
        ];
    }
}
