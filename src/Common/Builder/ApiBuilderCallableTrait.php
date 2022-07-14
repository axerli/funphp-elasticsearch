<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Common\Builder;

trait ApiBuilderCallableTrait
{
    /**
     * @var AbstractBuilder[]
     */
    protected array $apiBuilders = [];

    /**
     * @return AbstractBuilder[]
     */
    public function getApiBuilders(): array
    {
        return $this->apiBuilders;
    }

    /**
     * @return array
     */
    public function formatBuilders(): array
    {
        if (!$this->apiBuilders) {
            return [];
        }

        $dsl = [];
        foreach ($this->apiBuilders as $apiBuilder) {
            $dsl = array_merge($dsl, $apiBuilder->format());
        }

        return $dsl;
    }
}
