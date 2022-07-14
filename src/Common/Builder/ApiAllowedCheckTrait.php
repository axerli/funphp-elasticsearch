<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Common\Builder;

use Funphp\Elasticsearch\Search\SearchApiNotFoundException;

trait ApiAllowedCheckTrait
{
    /**
     * @param string $api
     * @return string
     */
    private function getApiClass(string $api): string
    {
        if (!array_key_exists($api, $this->allowedApis)) {
            throw new SearchApiNotFoundException($api);
        }

        return $this->allowedApis[$api];
    }
}
