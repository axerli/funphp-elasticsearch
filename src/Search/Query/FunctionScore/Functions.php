<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query\FunctionScore;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

/**
 * @method filter()
 */
class Functions extends AbstractBuilder
{
    protected string $apiName = 'functions';

    public function __construct(Closure $functions)
    {
        $functions($this);
        parent::__construct();
    }

    /**
     * @param Closure $function
     * @return $this
     */
    public function function(Closure $function): Functions
    {
        $this->apiBuilders[] = new FunctionBuilder($function);

        return $this;
    }

    public function queryDsl()
    {
        $dsl = [];
        foreach ($this->apiBuilders as $builder) {
            $dsl[] = $builder->format();
        }

        return $dsl;
    }
}
