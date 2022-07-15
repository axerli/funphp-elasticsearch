<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query\FunctionScore;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;
use Funphp\Elasticsearch\Search\Query\Group\Query;
use Funphp\Elasticsearch\Search\Script\Script;
use Illuminate\Support\Collection;

class FunctionScore extends AbstractBuilder
{
    protected string $apiName = 'function_score';

    private string $boostMode = 'multiply';

    private string $scoreMode = 'multiply';

    private array $formattedFunctions = [];

    private ?Functions $functions = null;

    private ?Script $scriptScore = null;

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

    public function scriptScore(Script $script): FunctionScore
    {
        $this->scriptScore = $script;

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
        $this->functions = new Functions($functions);

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
        return collect([
            'boost_mode' => $this->boostMode,
            'score_mode' => $this->scoreMode,
        ])
            ->when($this->scriptScore,
                fn(Collection $collect) => $collect->put('script_score', $this->scriptScore->format())
            )->merge($this->formatBuilders())
            ->merge($this->functionsFormat())
            ->toArray();
    }

    /**
     * @return array[]
     */
    private function functionsFormat(): array
    {
        $functions = $this->formattedFunctions;
        if ($this->functions) {
            $functions[] = $this->functions->queryDsl();
        }

        if (empty($functions)) {
            return [];
        }

        return [
            'functions' => $functions
        ];
    }
}
