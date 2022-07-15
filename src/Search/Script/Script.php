<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Script;

use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class Script extends AbstractBuilder
{
    protected string $apiName = 'script';

    protected string $lang = 'painless';

    protected array $params = [];

    protected string $source = '';

    public function lang(string $lang)
    {
        $this->lang = $lang;

        return $this;
    }

    public function params(array $params)
    {
        $this->params = $params;

        return $this;
    }

    public function source(string $source)
    {
        $this->source = $source;

        return $this;
    }

    public function queryDsl()
    {
        return [
            'lang'   => $this->lang,
            'source' => $this->source,
            'params' => (object) $this->params,
        ];
    }

}