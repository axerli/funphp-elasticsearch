<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class Range extends AbstractBuilder
{
    protected string $apiName = 'range';

    protected array $operators = [];

    public function __construct(string $field, Closure $closure)
    {
        parent::__construct($field);
        $closure($this);
    }

    /**
     * @param $value
     * @return $this
     */
    public function lt($value): Range
    {
        $this->operators['lt'] = $value;

        return $this;
    }

    public function lte($value): Range
    {
        $this->operators['lte'] = $value;

        return $this;
    }

    public function gt($value): Range
    {
        $this->operators['gt'] = $value;

        return $this;
    }

    public function gte($value): Range
    {
        $this->operators['gte'] = $value;

        return $this;
    }

    public function from($value): Range
    {
        $this->operators['from'] = $value;

        return $this;
    }

    public function to($value): Range
    {
        $this->operators['to'] = $value;

        return $this;
    }

    public function queryDsl(): array
    {
        return [
            $this->field => $this->operators,
        ];
    }
}
