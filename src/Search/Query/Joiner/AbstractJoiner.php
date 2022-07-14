<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query\Joiner;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;
use Funphp\Elasticsearch\Search\Query\Group\Query;

abstract class AbstractJoiner extends AbstractBuilder
{
    protected string $typeKey = 'type';

    protected string $type = '';

    public function __construct(string $type, Closure $closure)
    {
        parent::__construct();

        $this->type = $type;

        $closure($this);
    }

    /**
     * @param Closure $query
     * @return $this
     */
    public function query(Closure $query): self
    {
        $this->apiBuilders[] = new Query($query);

        return $this;
    }

    public function queryDsl()
    {
        return array_merge([
            $this->typeKey => $this->type,
        ], $this->formatBuilders());
    }
}
