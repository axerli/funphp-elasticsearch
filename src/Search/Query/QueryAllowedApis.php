<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Closure;
use Funphp\Elasticsearch\Common\Builder\ApiAllowedCheckTrait;
use Funphp\Elasticsearch\Search\Query\FunctionScore\FunctionScore;
use Funphp\Elasticsearch\Search\Query\Joiner\HasChild;
use Funphp\Elasticsearch\Search\Query\Joiner\HasParent;

trait QueryAllowedApis
{
    use ApiAllowedCheckTrait;

    protected array $allowedApis = [
        'term'              => Term::class,
        'termKeyword'       => TermKeyword::class,
        'terms'             => Terms::class,
        'matchAll'          => MatchAll::class,
        'match'             => MatchQuery::class,
        'matchPhrase'       => MatchPhrase::class,
        'matchPhrasePrefix' => MatchPhrasePrefix::class,
        'wildcard'          => Wildcard::class,
        'exists'            => Exists::class,
        'ids'               => Ids::class,
        'range'             => Range::class,
        'bool'              => BoolQuery::class,
        'hasParent'         => HasParent::class,
        'hasChild'          => HasChild::class,
        'functionScore'     => FunctionScore::class,
        'nested'            => Nested::class,
        'multiMatch'        => MultiMatch::class,
    ];

    public function __construct(Closure $closure)
    {
        parent::__construct();
        $closure($this);
    }

    public function __call($name, $arguments)
    {
        $class = $this->getApiClass($name);

        $builder = new $class(...$arguments);

        return tap($this, fn() => $this->apiBuilders[] = $builder);
    }

    public function queryDsl(): array
    {
        return $this->formatBuilders();
    }
}
