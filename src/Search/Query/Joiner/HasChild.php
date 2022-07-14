<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query\Joiner;

class HasChild extends AbstractJoiner
{
    protected string $apiName = 'has_child';

    protected string $typeKey = 'type';

}
