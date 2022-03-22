<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_country', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name')->nullable();
          $table->string('iso_code_2')->nullable();
          $table->string('iso_code_3')->nullable();
          $table->timestamp('created_at');
          $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_country');
    }
}
