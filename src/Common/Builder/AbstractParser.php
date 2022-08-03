<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Common\Builder;

use Funphp\Elasticsearch\Common\AbstractRequest;

abstract class AbstractParser implements ParserInterface
{
    /**
     * @var AbstractRequest
     */
    protected $request;

    public function parse(AbstractRequest $request): array
    {
        return [];
    }
}
