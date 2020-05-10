<?php


namespace Finoux\DB;

use Illuminate\Support\ServiceProvider;

class DBServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/api_status_code.php', 'api_status_code'
        );
      
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/api_status_code' => config_path('api_status_code'),
        ]);
    }
}
