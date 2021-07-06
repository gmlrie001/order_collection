<?php

use Illuminate\Support\Facades\Config;

// Route::get( 
//   config( 'portfolio.frontend.listing.route' ), 
//   config( 'portfolio.frontend.listing.namespace' ).config( 'portfolio.frontend.listing.actor').'@'.config( 'portfolio.frontend.listing.method' )
// )->name( 
//   config( 'portfolio.frontend.actions.listing.name' )
// );

Route::get( '/investments/portfolio', function() {
  $site_settings = \App\Models\Site::first();
  $portfolio = ( new \Vault\Portfolio\Models\Portfolio )->with( 'category' )->status()->latest();
  $category  = $portfolio->first()->category; // ->where( 'id', 1 )->first();
  // $category->load( 'portfolios' );
  dd( $portfolio->count(), $portfolio->first(), $category, count( $category->portfolios ) );

  return;
})->name( 'portfolios' );
Route::view( '/investments/portfolio', 'portfolio::listing' );
Route::get( '/investments/portfolio', 'Vault\Portfolio\Controllers\Page\PortfolioController@index' )->name( 'portfolios' );

// Route::get( config( 'portfolio.frontend.specific.route' ) . '/{' . config( 'portfolio.frontend.specific.input' ) . '}', config( 'portfolio.actions.specificActor' ) )->name( config( 'portfolio.actions.specificName' ) );

