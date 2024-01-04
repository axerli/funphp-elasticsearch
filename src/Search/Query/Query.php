<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

/**
 * @method Query term(string $field, string|int $value)
 * @method Query termKeyword(string $field, string $value)
 * @method Query terms(string $field, array $values)
 * @method Query matchAll()
 * @method Query match(string $field, string $value)
 * @method Query matchPhrase(string $field, Closure $closure)
 * @method Query matchPhrasePrefix(string $field, Closure $closure)
 * @method Query wildcard(string $field, string $value)
 * @method Query exists(string $field)
 * @method Query ids(array $values)
 * @method Query range(string $field, Closure $closure)
 * @method Query bool(Closure $closure)
 * @method Query hasParent(string $parentType, Closure $closure)
 * @method Query hasChild(string $type, Closure $closure)
 * @method Query functionScore(Closure $closure)
 * @method Query nested(string $path, Closure $closure)
 * @method Query multiMatch(Closure $closure)
 */
class Query extends AbstractBuilder
{
    use QueryAllowedApis;

    protected string $apiName = 'query';
}
