<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search\Sort;

use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class SortScript extends AbstractBuilder
{
    protected string $apiName = '_script';

    private string $type;

    private string $order;

    private string $script = '';

    private string $lang = 'painless';

    private array $params = [];

    public function __construct(string $type, string $order = 'asc')
    {
        parent::__construct();

        $this->type  = $type;
        $this->order = $order;
    }

    /**
     * @param string $script
     * @return SortScript
     */
    public function script(string $script): self
    {
        $this->script = $script;
        return $this;
    }

    /**
     * @param string $lang
     * @return $this
     */
    public function lang(string $lang): SortScript
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function params(array $params): SortScript
    {
        $this->params = $params;

        return $this;
    }

    public function queryDsl(): array
    {
        return [
            'type'   => $this->type,
            'order'  => $this->order,
            'script' => [
                'lang'   => $this->lang,
                'source' => $this->script,
                'params' => (object) $this->params,
            ],
        ];
    }
}
