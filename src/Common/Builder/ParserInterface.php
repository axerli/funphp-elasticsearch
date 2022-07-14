<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Common\Builder;

use Funphp\Elasticsearch\Common\AbstractRequest;

interface ParserInterface
{
    /**
     * @param AbstractRequest $request
     * @return array
     */
    public function parse(AbstractRequest $request): array;

}
