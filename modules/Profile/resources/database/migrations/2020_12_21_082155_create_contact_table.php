<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('organization')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->integer('address_id')->nullable()->unsigned();
            $table->foreign('address_id')->references('id')->on('address');
            $table->integer('status')->default(0);
            $table->integer('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('address_string')->nullable();
            $table->string('ic_passport')->nullable();
            $table->string('data')->nullable();
            $table->string('fax_number')->nullable();
            $table->timestamp('created_at')->nullable();
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
        Schema::dropIfExists('contact');
    }
}
