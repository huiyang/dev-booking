<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription', function (Blueprint $table) {
          $table->increments('id');
          $table->string('subscription_identity');
          $table->decimal('price');
          $table->integer('purchased_unit');
          $table->integer('used_unit');
          $table->string('content_valid_period')->nullable();
          $table->integer('content_valid_period_type')->default(3);
          $table->integer('status');
          $table->integer('owned_by');
          $table->timestamp('expire_at')->nullable();
          $table->timestamp('created_at')->nullable();
          $table->timestamp('updated_at')->nullable();
          $table->integer('invoice_id')->nullable()->unsigned();
          $table->foreign('invoice_id')->references('id')->on('payment_invoice');
          $table->integer('app_id')->nullable();
          $table->integer('package_id')->nullable()->unsigned();
          $table->foreign('package_id')->references('id')->on('subscription_package');
          $table->integer('bundle_id')->nullable()->unsigned();
          $table->foreign('bundle_id')->references('id')->on('subscription_bundle');
          $table->integer('priority')->nullable()->default(0);
          $table->integer('item_id')->nullable();
          $table->integer('item_class_id')->nullable()->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription');
    }
}
