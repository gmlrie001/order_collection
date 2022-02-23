<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsForCollectionToBasketsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if ( ! Schema::hasColumn( 'baskets', 'collection_code' ) ) {

      Schema::table( 'baskets', function (Blueprint $table) {
        $table->string( 'collection_code', 20 )
              ->nullable()->after( 'payment_method' );
      });

    }

    // if ( ! Schema::hasColumn( 'baskets', 'collection_id' ) ) {

    //   Schema::table( 'baskets', function (Blueprint $table) {
    //     $table->bigInteger( 'collection_id')
    //           ->unSigined()->default(1)->nullable()
    //           ->after( 'collection_code' );
    //   });

    // }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    if ( Schema::hasColumn( 'baskets', 'collection_code' ) ) {

      Schema::table( 'baskets', function (Blueprint $table) {
        $table->dropColumn( 'collection_code' );
      });

    }

    // if ( Schema::hasColumn( 'baskets', 'collection_id' ) ) {

    //   Schema::table( 'baskets', function (Blueprint $table) {
    //     $table->dropColumn( 'collection_id' );
    //   });

    // }
  }

}
