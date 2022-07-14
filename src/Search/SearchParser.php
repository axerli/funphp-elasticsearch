<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search;

use Funphp\Elasticsearch\Common\AbstractRequest;
use Funphp\Elasticsearch\Common\Builder\AbstractParser;

class SearchParser extends AbstractParser
{
    /**
     * @param AbstractRequest|SearchRequest $request
     * @return array
     */
    public function parse(AbstractRequest $request): array
    {
        $body = [];

        $apiBuilders = $request->getApiBuilders();
        foreach ($apiBuilders as $apiBuilder) {
            $body = array_merge($body, $apiBuilder->format());
        }

        return [
            'body'  => $body,
            'index' => $request->index,
        ];
    }
}
