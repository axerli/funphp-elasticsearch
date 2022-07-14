<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class MatchAll extends AbstractBuilder
{
    protected string $apiName = 'match_all';

    public function queryDsl(): object
    {
        return (object) [];
    }

}
