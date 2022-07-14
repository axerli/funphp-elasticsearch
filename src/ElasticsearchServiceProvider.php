<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch;

use Illuminate\Support\ServiceProvider;

class ElasticsearchServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/funphp.php' => config_path('funphp.php'),
        ], 'funphp');
    }
}
