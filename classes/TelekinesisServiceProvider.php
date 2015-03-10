<?php namespace Keios\Telekinesis\Classes;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class TelekinesisServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'telekinesis.connections',
            function () {
                return new ConnectionConfigurator($this->app['config']);
            }
        );

        $this->app->register('Collective\Remote\RemoteServiceProvider');

        $alias = AliasLoader::getInstance();
        $alias->alias('SSH', 'Collective\Remote\RemoteFacade');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'telekinesis.connections',
        ];
    }

}
