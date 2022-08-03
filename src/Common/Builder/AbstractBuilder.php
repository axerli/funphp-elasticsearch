<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Common\Builder;

use Illuminate\Contracts\Support\Arrayable;

abstract class AbstractBuilder implements BuilderInterface
{
    use ApiBuilderCallableTrait;

    protected string $apiName = '';

    protected string $field = '';

    /**
     * @var mixed|null
     */
    protected $value;

    /**
     * @param string $field
     * @param        $value
     */
    public function __construct(string $field = '', $value = null)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getApiName(): string
    {
        return $this->apiName;
    }

    public function queryDsl()
    {
        return $this->value;
    }

    public function format(): array
    {
        $queryDsl = $this->queryDsl();

        return [
            $this->apiName => $queryDsl instanceof Arrayable ? $queryDsl->toArray() : $queryDsl,
        ];
    }
}
