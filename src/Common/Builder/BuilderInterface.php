<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Common\Builder;

use Funphp\Elasticsearch\Document\Builders\Builder;

interface BuilderInterface
{
    /**
     * @return array
     */
    public function format(): array;

    /**
     * @return mixed
     */
    public function queryDsl();

    /**
     * @return Builder[]
     */
    public function getApiBuilders(): array;
}
