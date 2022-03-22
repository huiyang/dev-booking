<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('address', function(Blueprint $table){
        $table->integer('old_id')->nullable()->default(null);
        $table->string('address_3')->nullable()->default(null);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('address', function(Blueprint $table){
        $table->dropColumn('old_id');
        $table->dropColumn('address_3');
      });
    }
}
