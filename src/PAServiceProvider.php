<?php namespace PostcodeAnywhere;

use Illuminate\Support\ServiceProvider;


class PAServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/postcodeanywhere.php' => config_path('/postcodeanywhere.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPostcodeAnywhere();

        $this->app->alias('pa', PostcodeAnywhere::class);
    }
    /***/

    /**
     * Register the PostcodeAnywheer builder instance.
     *
     * @return void
     */
    protected function registerPostcodeAnywhere()
    {
        $this->app->bind('pa', function ($app) {
            return new PostcodeAnywhere();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['pa'];
    }


}
