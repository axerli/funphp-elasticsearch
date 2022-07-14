<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;
use Funphp\Elasticsearch\Search\Query\Group\Query;

class Nested extends AbstractBuilder
{
    private string $path;

    protected string $apiName = 'nested';

    public function __construct(string $path, Closure $closure)
    {
        $this->path = $path;
        parent::__construct();
        $closure($this);
    }

    /**
     * @param Closure $query
     * @return $this
     */
    public function query(Closure $query): Nested
    {
        $this->apiBuilders[] = new Query($query);
        return $this;
    }

    public function queryDsl()
    {
        return array_merge([
            'path' => $this->path,
        ], $this->formatBuilders());
    }
}
