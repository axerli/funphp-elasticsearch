<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search;

use Funphp\Elasticsearch\Common\Builder\AbstractBuilder;

class Source extends AbstractBuilder
{
    protected string $apiName = '_source';

    public function __construct($fields = ['*'])
    {
        $fields = is_array($fields) ? $fields : func_get_args();

        parent::__construct('', $fields);
    }
}
