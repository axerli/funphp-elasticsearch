<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search;

use RuntimeException;

class SearchApiNotFoundException extends RuntimeException
{
    public function __construct(string $api)
    {
        parent::__construct(sprintf("The called api :[%s] Not Supported", $api));
    }
}
