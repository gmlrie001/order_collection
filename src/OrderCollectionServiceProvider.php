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
      $this->loadRoutesFrom( dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'routes/web.php');
      // $this->loadRoutesFrom( dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'routes/vault.php');

      $this->loadViewsFrom( dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'resources/views/order_collection', 'order_collection' );
      $this->publishes([
        dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'config/order_collection.php' => 
        config_path( 'order_collection.php' ),
      ], 'config');

      // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'order_collection');
      // if ($this->app->runningInConsole()) {
      //   $this->publishes([
      //       __DIR__.'/../config/order_collection.php' => config_path( 'order_collection.php' ),
      //     ], 'config');
        // Publishing the views.
        /*$this->publishes([
          __DIR__.'/../resources/views' => resource_path( 'views/vendor/order_collection' ),
        ], 'views' );*/
        // Publishing assets.
        /*$this->publishes([
          __DIR__.'/../resources/assets' => public_path( 'vendor/order_collection' ),
        ], 'assets' );*/
        // Publishing the translation files.
        /*$this->publishes([
          __DIR__.'/../resources/lang' => resource_path( 'lang/vendor/order_collection' ),
        ], 'lang' );*/
        // Registering package commands.
        // $this->commands([
        //   Console\Commands\order_collection::class
        // ]);
      // }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
      // Automatically apply the package configuration
      $this->mergeConfigFrom( dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'config/order_collection.php', 'order_collection') ;

      // Register the main class to use with the facade
      $this->app->singleton( 'order_collection', function () {
        return new OrderCollection();
      });

      // // Bind to main package class
      // $this->app->bind( 'Portfolio', function () {
     	//   return new Vault\Portfolio\Portfolio();
      // });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
      return [
        // 'OrderCollection', 
        'order_collection'
      ];
    }

}
