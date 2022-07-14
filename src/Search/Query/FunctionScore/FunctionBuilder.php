<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query\FunctionScore;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;
use Funphp\Elasticsearch\Search\Query\Group\Filter;

class FunctionBuilder extends AbstractBuilder
{
    private ?float $weight = null;

    private ?float $seed = null;

    private ?string $script = null;

    public function __construct(Closure $closure)
    {
        $closure($this);
        parent::__construct();
    }

    public function filter(Closure $filter): FunctionBuilder
    {
        $this->apiBuilders[] = new Filter($filter);

        return $this;
    }

    public function weight(float $weight): FunctionBuilder
    {
        $this->weight = $weight;

        return $this;
    }

    public function randomScore(float $seed): FunctionBuilder
    {
        $this->seed = $seed;

        return $this;
    }

    public function scriptScore(string $script): FunctionBuilder
    {
        $this->script = $script;

        return $this;
    }

    public function format(): array
    {
        return collect()
            ->put('filter', $this->apiBuilders[0]->queryDsl())
            ->when($this->weight !== null, fn($collect) => $collect->put('weight', $this->weight))
            ->when($this->seed !== null, fn($collect) => $collect->put('random_score', [
                'seed' => $this->seed,
            ]))
            ->when($this->script !== null, fn($collect) => $collect->put('script_score', [
                'script' => $this->script,
            ]))
            ->toArray();
    }
}
