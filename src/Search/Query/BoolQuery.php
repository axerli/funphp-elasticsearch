<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;
use Funphp\Elasticsearch\Search\Query\Group\Query;
use Illuminate\Support\Str;

/**
 * @method BoolQuery must(Closure $closure)
 * @method BoolQuery should(Closure $closure)
 * @method BoolQuery filter(Closure $closure)
 * @method BoolQuery mustNot(Closure $closure)
 */
class BoolQuery extends AbstractBuilder
{
    protected string $apiName = 'bool';

    /**
     * @var <string,Query[]> $clauses
     */
    protected array $clauses = [];

    /* clauses
	 * ---------------------------------------- */
    private const CLAUSES_MUST     = 'must';
    private const CLAUSES_SHOULD   = 'should';
    private const CLAUSES_FILTER   = 'filter';
    private const CLAUSES_MUST_NOT = 'must_not';

    public function __construct(Closure $closure)
    {
        parent::__construct();
        $closure($this);
    }

    public function __call($name, $arguments)
    {
        return $this->addClause($name, ...$arguments);
    }

    public function queryDsl(): array
    {
        $dsl     = [];
        $clauses = [self::CLAUSES_MUST, self::CLAUSES_SHOULD, self::CLAUSES_FILTER, self::CLAUSES_MUST_NOT];
        foreach ($clauses as $clause) {
            $dsl = array_merge($dsl, $this->parseClauses($clause));
        }

        return $dsl;
    }

    /**
     * @param string  $type
     * @param Closure $closure
     * @return $this
     */
    protected function addClause(string $type, Closure $closure): self
    {
        $type = Str::snake($type);

        $this->clauses[$type][] = new Query($closure);

        return $this;
    }

    /**
     * parse the clauses to query
     * @param string $clauseType
     * @return array
     */
    protected function parseClauses(string $clauseType = self::CLAUSES_MUST): array
    {
        $clauses = $this->clauses[$clauseType] ?? [];
        if (!$clauses) {
            return [];
        }

        $query = [];
        /** @var Query $clause */
        foreach ($clauses as $clause) {
            foreach ($clause->getApiBuilders() as $builder) {
                $query[] = $builder->format();
            }
        }

        return [
            $clauseType => $query,
        ];
    }
}
