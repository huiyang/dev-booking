<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCreateSubscriptionBundleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_bundle', function(Blueprint $table){
          $table->integer('old_id')->nullable()->default(null);
          $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('subscription_bundle', function(Blueprint $table){
        $table->dropColumn('old_id');
        $table->dropColumn('note');
        $table->dropColumn('updated_at');
      });
    }
}
