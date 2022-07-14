<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search;

use Funphp\Elasticsearch\Client\Client;

trait RequestTrait
{

    /**
     * @return SearchRequest
     */
    public static function searchable(): SearchRequest
    {
        return (new static())->searchRequest();
    }

    /**
     * @return SearchRequest
     */
    public function searchRequest(): SearchRequest
    {
        return (new SearchRequest($this->newClient(), new SearchParser()))
            ->index($this->searchableIndex());
    }

    /**
     * @return Client
     */
    protected function newClient(): Client
    {
        return new Client();
    }
}
