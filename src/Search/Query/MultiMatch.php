<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;
use Closure;

class MultiMatch extends AbstractBuilder
{
    protected string $apiName = 'multi_match';

    private string $query = '';

    private array $fields = [];

    private string $type = 'best_fields';

    private ?float $tieBreaker = null;

    public function __construct(Closure $closure)
    {
        parent::__construct();
        $closure($this);
    }

    /**
     * @param string $query
     * @return $this
     */
    public function query(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function fields($fields): self
    {
        $fields = is_array($fields) ? $fields : func_get_args();

        $this->fields = $fields;

        return $this;
    }

    public function type(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function tieBreaker(float $tieBreaker): self
    {
        $this->tieBreaker = $tieBreaker;

        return $this;
    }

    public function queryDsl()
    {
        return collect([
            'query'  => $this->query,
            'fields' => $this->fields,
            'type'   => $this->type,
        ])->when($this->tieBreaker, fn($collect) => $collect->put('tie_breaker', $this->tieBreaker));
    }
}
