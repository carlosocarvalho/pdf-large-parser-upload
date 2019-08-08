<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;
use App\Bi\ElasticSearchEngine;
use Elasticsearch\ClientBuilder;

class ElasticSearchScoutServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        resolve(EngineManager::class)->extend('elasticsearch', function($app){
              return new ElasticSearchEngine(
                  ClientBuilder::create()
                  ->setHosts(config('elasticsearch.hosts'))
                ->build(),  config('elasticsearch.queries'));
        });
    }
}
