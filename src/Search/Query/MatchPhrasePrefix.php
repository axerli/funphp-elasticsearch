<?php
declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class MatchPhrasePrefix extends AbstractBuilder
{
    protected string $apiName = 'match_phrase_prefix';

    protected array $params = [];

    public function __construct(string $field = '', Closure $closure)
    {
        parent::__construct($field);
        $closure($this);
    }

    public function query(string $query): MatchPhrasePrefix
    {
        $this->params['query'] = $query;
        return $this;
    }

    public function maxExpansions(int $maxExpansions): MatchPhrasePrefix
    {
        $this->params['max_expansions'] = $maxExpansions;
        return $this;
    }

    public function analyzer(string $analyzer): MatchPhrasePrefix
    {
        $this->params['analyzer'] = $analyzer;
        return $this;
    }

    public function prefixLength(int $prefixLength): MatchPhrasePrefix
    {
        $this->params['prefix_length'] = $prefixLength;
        return $this;
    }

    public function fuzziness(float $fuzziness): MatchPhrasePrefix
    {
        $this->params['fuzziness'] = $fuzziness;
        return $this;
    }

    public function queryDsl(): array
    {
        return [
            $this->field => $this->params,
        ];
    }
}
