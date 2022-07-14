<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query\Joiner;

class HasParent extends AbstractJoiner
{
    protected string $apiName = 'has_parent';

    protected string $typeKey = 'parent_type';

}
