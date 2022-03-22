<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCreateSubscriptionPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('subscription_package', function(Blueprint $table){
           $table->integer('old_id')->nullable()->default(null);
           $table->decimal('fine_rate')->default(0.00);
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('subscription_package', function(Blueprint $table){
           $table->dropColumn('old_id');
           $table->dropColumn('fine_rate');
         });
     }
}
