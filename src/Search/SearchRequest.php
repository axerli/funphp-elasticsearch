<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search;

use Closure;
use Funphp\Elasticsearch\Common\AbstractRequest;
use Funphp\Elasticsearch\Common\Builder\ApiAllowedCheckTrait;
use Funphp\Elasticsearch\Common\Builder\ApiBuilderCallableTrait;
use Funphp\Elasticsearch\Search\Query\Group\Query;
use Funphp\Elasticsearch\Search\Sort\Sort;

/**
 * @property int|string $searchableId
 * @method SearchRequest query(Closure $closure)
 * @method SearchRequest from(int $from)
 * @method SearchRequest size(int $size)
 * @method SearchRequest source(mixed|array $fields = ['*'])
 * @method SearchRequest sort(Closure $closure)
 * @method SearchRequest aggs(Closure $closure)
 */
class SearchRequest extends AbstractRequest
{
    use ApiAllowedCheckTrait, ApiBuilderCallableTrait;

    protected array $allowedApis = [
        'query'  => Query::class,
        'from'   => From::class,
        'size'   => Size::class,
        'source' => Source::class,
        'sort'   => Sort::class,
        'aggs'   => Aggregation::class,
    ];

    public function __call($name, $arguments)
    {
        $class = $this->getApiClass($name);

        $builder = new $class(...$arguments);

        return tap($this, fn() => $this->apiBuilders[] = $builder);
    }

    /**
     * @param int|string $id
     * @return SearchRequest
     */
    public function searchableId($id): SearchRequest
    {
        $this->searchableId = $id;

        return $this;
    }

    public function search()
    {
        return $this->client->search($this->parser->parse($this));
    }
}
