<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

/**
 * @method Filter term(string $field, string|int $value)
 * @method Filter termKeyword(string $field, string $value)
 * @method Filter terms(string $field, array $values)
 * @method Filter matchAll()
 * @method Filter match(string $field, string $value)
 * @method Query  matchPhrase(string $field, Closure $closure)
 * @method Query  matchPhrasePrefix(string $field, Closure $closure)
 * @method Filter wildcard(string $field, string $value)
 * @method Filter exists(string $field)
 * @method Filter ids(array $values)
 * @method Filter range(string $field, Closure $closure)
 * @method Filter bool(Closure $closure)
 * @method Filter hasParent(string $parentType, Closure $closure)
 * @method Filter hasChild(string $type, Closure $closure)
 */
class Filter extends AbstractBuilder
{
    use QueryAllowedApis;

    protected string $apiName = 'filter';
}
