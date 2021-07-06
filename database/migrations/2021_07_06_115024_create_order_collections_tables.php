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

        $table->timestamps();
        $table->softDeletes();

        $table->enum( 'status', ['PUBLISHED','UNPUBLISHED','SCHEDULED','DRAFT'] )
              ->default('PUBLISHED')->nullable();
        $table->dateTime( 'status_date' )->nullable();

        $table->bigInteger( 'order' )->default(1)->nullable();
      });
    }

    $n = count( config('order_collection.collection_point_seeder') );
    for ( $i = 0; $i < $n; $i++ ) {
      \DB::table( 'collection_points' )->insert([
        $i => config('order_collection.collection_point_seeder')[$i],
      ]);
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    if ( Schema::hasTable( 'collection_points' ) ) {
      \DB::table( 'collection_points' )->truncate();
      Schema::dropIfExists('collection_points');
    }
  }

}
