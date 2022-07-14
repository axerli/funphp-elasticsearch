<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch;


use Funphp\Elasticsearch\Search\RequestTrait;
use Illuminate\Support\Str;

trait Searchable
{
    use RequestTrait;

    /**
     * @return string
     */
    public function searchableIndex(): string
    {
        return Str::camel(class_basename($this));
    }
}
