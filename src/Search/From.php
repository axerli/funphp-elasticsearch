<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search;

use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class From extends AbstractBuilder
{
    protected string $apiName = 'from';

    public function __construct(int $offset)
    {
        parent::__construct('', $offset);
    }
}
