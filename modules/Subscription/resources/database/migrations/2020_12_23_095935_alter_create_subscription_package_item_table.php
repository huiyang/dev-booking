<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCreateSubscriptionPackageItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_package_item', function(Blueprint $table){
          $table->integer('old_id')->nullable()->default(null);
          $table->integer('book_limit');
          $table->integer('max_cant_reserve_period');
          $table->integer('max_collectable_period');
          $table->integer('max_no_of_renew');
          $table->integer('max_no_of_reservations');
          $table->integer('max_uncollected_no');
          $table->integer('min_renewable_period');
          $table->integer('resume_borrowable_period');
          $table->string('start_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('subscription_package_item', function(Blueprint $table){
        $table->dropColumn('old_id');
        $table->dropColumn('book_limit');        
        $table->dropColumn('max_cant_reserve_period');
        $table->dropColumn('max_collectable_period');
        $table->dropColumn('max_no_of_renew');
        $table->dropColumn('max_no_of_reservations');
        $table->dropColumn('max_uncollected_no');
        $table->dropColumn('min_renewable_period');
        $table->dropColumn('resume_borrowable_period');
        $table->dropColumn('start_date');
      });
    }
}
