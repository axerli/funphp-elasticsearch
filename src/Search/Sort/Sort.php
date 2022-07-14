<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Sort;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class Sort extends AbstractBuilder
{
    protected string $apiName = 'sort';

    protected array $sorts = [];

    public function __construct(Closure $closure)
    {
        parent::__construct();

        $closure($this);
    }

    /**
     * @param string $column
     * @param string $order
     * @return $this
     */
    public function sortBy(string $column, string $order = 'asc'): self
    {
        $this->sorts[] = [
            $column => [
                'order' => $order,
            ],
        ];

        return $this;
    }

    public function sortByDesc(string $column): Sort
    {
        return $this->sortBy($column, 'desc');
    }

    /**
     * @param SortScript $sortScript
     * @return $this
     */
    public function sortByScript(SortScript $sortScript): Sort
    {
        $this->apiBuilders[] = $sortScript;

        return $this;
    }

    public function queryDsl(): array
    {
        foreach ($this->apiBuilders as $apiBuilder) {
            $this->sorts[] = $apiBuilder->format();
        }

        return $this->sorts;
    }
}
