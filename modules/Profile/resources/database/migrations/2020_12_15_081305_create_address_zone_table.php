<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressZoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('address_zone', function (Blueprint $table) {
        $table->increments("id");
        $table->integer('country_id')->unsigned();
        $table->foreign('country_id')->references('id')->on('address_country');
        $table->string('name');
        $table->string('code');
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
        Schema::dropIfExists('address_zone');
    }
}
