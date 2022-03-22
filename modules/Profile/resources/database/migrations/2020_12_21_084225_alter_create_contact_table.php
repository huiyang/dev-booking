<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact', function(Blueprint $table){
          $table->integer('old_id')->nullable()->default(null);
          $table->string('tel')->nullable();
          $table->string('name2')->nullable();
          $table->string('gender')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact', function(Blueprint $table){
          $table->dropColumn('old_id');
          $table->dropColumn('tel');
          $table->dropColumn('name2');
          $table->dropColumn('gender');
        });
    }
}
