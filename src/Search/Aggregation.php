<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;
use Str;

/**
 * @method Aggregation valueCount(string $name, string $field)
 * @method Aggregation avg(string $name, string $field)
 * @method Aggregation max(string $name, string $field)
 * @method Aggregation min(string $name, string $field)
 * @method Aggregation sum(string $name, string $field)
 * @method Aggregation aggs(Closure $closure)
 */
class Aggregation extends AbstractBuilder
{
    protected string $apiName = 'aggs';

    protected array $aggregation = [];

    /**
     * @var Aggregation[]
     */
    protected array $nestAggs = [];

    public function __construct(Closure $closure)
    {
        parent::__construct();

        $closure($this);
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this|Aggregation
     */
    public function __call($name, $arguments)
    {
        if ($name === $this->apiName) {
            $closure = $arguments[0];

            $this->nestAggs[] = new self($closure);

            return $this;
        }

        return $this->addAggregation($name, ...$arguments);
    }

    public function queryDsl(): array
    {
        return array_merge($this->aggregation, $this->formatNestAggs());
    }

    /**
     * @param string $type
     * @param string $name
     * @param string $field
     * @return $this
     */
    protected function addAggregation(string $type, string $name, string $field): Aggregation
    {
        $name = Str::snake($name);

        $this->aggregation[$name] = [
            $type => [
                'field' => $field,
            ],
        ];

        return $this;
    }

    /**
     * @return array
     */
    protected function formatNestAggs(): array
    {
        if (!$this->nestAggs) {
            return [];
        }

        $dsl = [];
        foreach ($this->nestAggs as $agg) {
            $dsl = array_merge($dsl, $agg->format());
        }

        return $dsl;
    }
}
