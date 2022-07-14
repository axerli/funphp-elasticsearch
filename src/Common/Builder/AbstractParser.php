<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Common\Builder;

use Funphp\Elasticsearch\Common\AbstractRequest;
use Funphp\Elasticsearch\Document\Builders\Builder;

abstract class AbstractParser implements ParserInterface
{
    /**
     * @var AbstractRequest
     */
    protected $request;

    /**
     * @var array|Builder[]
     */
    protected array $builder = [];

    public function parse(AbstractRequest $request): array
    {
        return [];
    }
}
