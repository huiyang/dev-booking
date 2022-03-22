<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPackageItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_package_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subscription_identity');
            $table->string('name');
            $table->integer('unit');
            $table->string('valid_period')->nullable();
            $table->integer('valid_period_type')->nullable();
            $table->string('content_valid_period')->nullable();
            $table->integer('content_valid_period_type')->nullable();
            $table->integer('status');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('subscription_package');
            $table->integer('priority')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_package_item');
    }
}
