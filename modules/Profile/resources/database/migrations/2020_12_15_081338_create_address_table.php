<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('address', function (Blueprint $table) {
        $table->increments('id');
        $table->string('firstname')->nullable();
        $table->string('lastname')->nullable();
        $table->string('company')->nullable();
        $table->string('venue')->nullable();
        $table->string('address_1')->nullable();
        $table->string('address_2')->nullable();
        $table->string('city')->nullable();
        $table->string('postcode')->nullable();
        $table->integer('country_id')->unsigned()->nullable();
        $table->foreign('country_id')->references('id')->on('address_country');
        $table->integer('zone_id')->unsigned()->nullable();
        $table->foreign('zone_id')->references('id')->on('address_zone');
        $table->string('custom_state')->nullable();
        $table->integer('readonly')->default(0);
        $table->integer('del')->default(0);
        $table->integer('latitude')->nullable();
        $table->integer('longitude')->nullable();
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
