<?php

namespace Vault\OrderCollection;

use Illuminate\Support\ServiceProvider;


class OrderCollectionServiceProvider extends ServiceProvider
{  
    protected $defer = false;

    
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
      /**
       * 
       * Optional methods to load your package assets
       * 
       */
      $this->loadMigrationsFrom( dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'database/migrations');
      $this->loadViewsFrom( dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'resources/views/order_collection', 'order_collection' );
      $this->loadRoutesFrom( dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'routes/web.php');
      // $this->loadRoutesFrom( dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'routes/vault.php');
      $this->publishes([
        dirname( __DIR__ ) .DIRECTORY_SEPARATOR. 'config/order_collection.php' => config_path( 'order_collection.php' ), 
      ], 'order_collection_config');
      // dirname( __DIR__ ) .DIRECTORY_SEPARATOR. 'config/order_collection.php' => config_path( 'order_collection.php' ), 
      $this->publishes([
        __DIR__ .DIRECTORY_SEPARATOR. 'Models' .DIRECTORY_SEPARATOR. 'Publish' .DIRECTORY_SEPARATOR. 'CollectionPoint.php' => app_path('Models' .DIRECTORY_SEPARATOR. 'CollectionPoint.php'), 
        __DIR__ .DIRECTORY_SEPARATOR. 'Requests' .DIRECTORY_SEPARATOR. 'Publish' .DIRECTORY_SEPARATOR. 'CollectionPoint' .DIRECTORY_SEPARATOR. 'CreateRequest.php' => app_path('Http' .DIRECTORY_SEPARATOR. 'Requests' .DIRECTORY_SEPARATOR. 'CollectionPoint' .DIRECTORY_SEPARATOR. 'CreateRequest.php'), 
        __DIR__ .DIRECTORY_SEPARATOR. 'Requests' .DIRECTORY_SEPARATOR. 'Publish' .DIRECTORY_SEPARATOR. 'CollectionPoint' .DIRECTORY_SEPARATOR. 'UpdateRequest.php' => app_path('Http' .DIRECTORY_SEPARATOR. 'Requests' .DIRECTORY_SEPARATOR. 'CollectionPoint' .DIRECTORY_SEPARATOR. 'UpdateRequest.php'), 
      ], 'order_collection');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
      // Automatically apply the package configuration
      $this->mergeConfigFrom( dirname( __DIR__ ) .DIRECTORY_SEPARATOR. 'config/order_collection.php', 'order_collection') ;
      // Register the main class to use with the facade
      $this->app->singleton('order_collection', function () { return new OrderCollection(); });
      // // Bind to main package class
      // $this->app->bind('Portfolio', function () { return new Vault\Portfolio\Portfolio(); });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
      return ['order_collection'/*, 'OrderCollection'*/];
    }

}
