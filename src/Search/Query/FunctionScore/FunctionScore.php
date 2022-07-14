<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query\FunctionScore;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;
use Funphp\Elasticsearch\Search\Query\Group\Query;

class FunctionScore extends AbstractBuilder
{
    protected string $apiName = 'function_score';

    private string $boostMode = 'multiply';

    private string $scoreMode = 'multiply';

    private array $formattedFunctions = [];

    public function __construct(Closure $closure)
    {
        parent::__construct();
        $closure($this);
    }

    /**
     * @param Closure $query
     * @return $this
     */
    public function query(Closure $query): FunctionScore
    {
        $this->apiBuilders[] = new Query($query);

        return $this;
    }

    public function boostMode(string $boostMode): FunctionScore
    {
        $this->boostMode = $boostMode;

        return $this;
    }

    public function scoreMode(string $scoreMode): FunctionScore
    {
        $this->scoreMode = $scoreMode;

        return $this;
    }

    /**
     * With addFunction mutex, you can add multiple functions using closure.
     * @param Closure $functions
     * @return $this
     */
    public function functions(Closure $functions): FunctionScore
    {
        $this->apiBuilders[] = new Functions($functions);

        return $this;
    }

    /**
     * With functions mutex, you can add multiple functions using array.
     * @param array $function
     * @return $this
     */
    public function addFunction(array $function): FunctionScore
    {
        $this->formattedFunctions[] = $function;

        return $this;
    }

    public function queryDsl()
    {
        return array_merge([
            'boost_mode' => $this->boostMode,
            'score_mode' => $this->scoreMode,
            'functions'  => $this->formattedFunctions,
        ], $this->formatBuilders());
    }
}
