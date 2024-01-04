<?php
declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Query;

use Closure;
use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class MatchPhrase extends AbstractBuilder
{
    protected string $apiName = 'match_phrase';

    protected array $params = [];

    public function __construct(string $field = '', Closure $closure)
    {
        parent::__construct($field);
        $closure($this);
    }

    public function query(string $query): MatchPhrase
    {
        $this->params['query'] = $query;
        return $this;
    }

    public function slop(int $slop): MatchPhrase
    {
        $this->params['slop'] = $slop;
        return $this;
    }

    public function analyzer(string $analyzer): MatchPhrase
    {
        $this->params['analyzer'] = $analyzer;
        return $this;
    }

    public function queryDsl(): array
    {
        return [
            $this->field => $this->params,
        ];
    }
}
