<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Common\Builder;

use Illuminate\Contracts\Support\Arrayable;

interface BuilderInterface
{
    /**
     * @return array
     */
    public function format(): array;

    /**
     * @return mixed|array|Arrayable
     */
    public function queryDsl();

    /**
     * @return BuilderInterface[]
     */
    public function getApiBuilders(): array;
}
