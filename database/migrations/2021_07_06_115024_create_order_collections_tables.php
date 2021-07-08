<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderCollectionsTables extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if ( ! Schema::hasTable( 'collection_points' ) ) {
      Schema::create( 'collection_points', function ( Blueprint $table ) {
        $table->increments( 'id' );

        $table->string( 'title' );
        $table->string( 'shipping_title' )->nullable();
        $table->longText( 'shipping_description' )->nullable();

        $table->text( 'address_line_1' )->nullable();
        $table->text( 'address_line_2' )->nullable();
        $table->text( 'postal_code' )->nullable();
        $table->text( 'suburb' )->nullable();
        $table->text( 'province' )->nullable();
        $table->text( 'city' )->nullable();
        $table->text( 'country' )->nullable();

        $table->text( 'latitude' )->nullable();
        $table->text( 'longitude' )->nullable();

        $table->text( 'shipping_time' )->nullable();
        $table->string( 'collection_code' )->nullable();
        $table->longText( 'trading_hours' )->nullable();
        $table->decimal( 'shipping_cost', 10, 2 )
              ->default(0.00)->nullable();

        // $table->bigInteger( 'basket_id' )->unSigined()->nullable();

        $table->timestamps();
        $table->softDeletes();

        $table->enum( 'status', ['PUBLISHED','UNPUBLISHED','SCHEDULED','DRAFT'] )
              ->default('PUBLISHED')->nullable();
        $table->dateTime( 'status_date' )->nullable();

        $table->bigInteger('order')->default(1)->nullable();
      });
    }

    /** Seeding table */
    $insertionArray = [];
    $n = count( config( 'order_collection.collection_point_seeder' ) ) - 1;

    foreach( range( 0, $n ) as $i ) {
      \DB::table( 'collection_points' )->insert([
        $i => config( 'order_collection.collection_point_seeder' )[$i], 
      ]);
      // $insertionArray[$i] = config( 'order_collection.collection_point_seeder' )[$i];
    }

  /*
    // \DB::beginTransaction();
    try {
      // \DB::table( 'collection_points' )->insert( $insertionArray );
      // \DB::commit();
      ( new \App\Models\CollectionPoint )->insert( $insertionArray );
      dump( ( new \App\Models\CollectionPoint )->get() );

    } catch ( \Exception $error ) {
      info( $error->getMessage() );
      // \DB::rollBack();
    }
    // \DB::commit();
    // dd( $insertionArray, ( new \App\Models\CollectionPoint ), \DB::table( 'collection_points' )->select( '*' ) );
  */
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    if ( Schema::hasTable( 'collection_points' ) ) {
      // \DB::table( 'collection_points' )->truncate();

      Schema::dropIfExists( 'collection_points' );
    }
  }

}
