<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBookableBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('bookable_bookings', function (Blueprint $table) {
            $table->nullableMorphs('detail');
            $table->string('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('bookable_bookings', function (Blueprint $table) {
            $table->dropMorphs('detail');
            $table->dropColumn('state');
        });
    }
}
