<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search;

use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class Size extends AbstractBuilder
{
    protected string $apiName = 'size';

    public function __construct(int $size)
    {
        parent::__construct('', $size);
    }
}
