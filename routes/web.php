<?php

use Illuminate\Support\Facades\Session;

/**
 * Frontend routes for this package
 */

Route::middleware( ['web'] )->group( function() {

  Route::post( 'cart/collection', '\Vault\OrderCollection\Http\Controllers\Page\CollectionPointController@index' );

});
