<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionBundleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_bundle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price');
            $table->integer('package_id')->nullable()->unsigned();
            $table->foreign('package_id')->references('id')->on('subscription_package');
            $table->integer('invoice_id')->nullable()->unsigned();
            $table->foreign('invoice_id')->references('id')->on('payment_invoice');
            $table->timestamps();
            $table->integer('organization_id')->nullable();
            $table->integer('owned_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_bundle');
    }
}
