<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnForCollectionToShippingOptionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if ( ! Schema::hasColumn( 'shipping_options', 'for_collection' ) ) {

      Schema::table( 'shipping_options', function (Blueprint $table) {
        $table->enum( 'for_collection', ['no', 'yes'] )->default('no')->nullable();
      });

    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    if ( Schema::hasColumn( 'shipping_options', 'for_collection' ) ) {

      Schema::table( 'shipping_options', function (Blueprint $table) {
        $table->dropColumn( 'for_collection' );
      });

    }
  }

}
