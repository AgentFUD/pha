<?php declare(strict_types=1);

namespace App\Services\PokerRankr;

use Illuminate\Support\ServiceProvider;
use App\Services\PokerRankr\Config\Config;

/**
 * Class PokerRankrServiceProvider
 *
 * @package App\Services\PokerRankr
 */
class PokerRankrServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the package.
     */
    public function boot()
    {
        /*
        |--------------------------------------------------------------------------
        | Publish the Config file from the Package to the App directory
        |--------------------------------------------------------------------------
        */
        $this->registerConfigPublisher();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PokerRankr::class, function ($app) {
            $config   = new Config();
            $handlers = $config->get($config->get('default'));

            return new PokerRankr($handlers);
        });

        $this->app->bind('PokerRankr', function ($app) {
            return $app->make(PokerRankr::class);
        });
    }

    /**
     * Registers the option of publishing the packages config file.
     */
    private function registerConfigPublisher()
    {
        // When users execute Laravel's vendor:publish command, the config file will be copied to the specified location
        $this->publishes([
            __DIR__ . '/Config/poker-rankr.php' => config_path('poker-rankr.php'),
        ], 'poker-rankr-config');
    }

    /**
     * Returns the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            PokerRankr::class,
        ];
    }
}
