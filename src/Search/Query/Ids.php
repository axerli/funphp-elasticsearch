<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class Ids extends AbstractBuilder
{
    protected string $apiName = 'ids';

    public function __construct(array $values)
    {
        parent::__construct('', $values);
    }

    public function queryDsl(): array
    {
        return [
            'values' => (array) $this->value,
        ];
    }
}
