<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('subscription_package', function (Blueprint $table) {
           $table->increments('id');
           $table->string('subscription_identity');
           $table->string('name');
           $table->decimal('price');
           $table->timestamp('created_at')->nullable();
           $table->timestamp('updated_at')->nullable();
           $table->integer('app_id')->nullable();
           $table->integer('show_in_signup')->default(1);
           $table->string('short_description')->nullable();
           $table->string('admin_note')->nullable();
           $table->string('options')->nullable();
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::dropIfExists('subscription_package');
     }
}
