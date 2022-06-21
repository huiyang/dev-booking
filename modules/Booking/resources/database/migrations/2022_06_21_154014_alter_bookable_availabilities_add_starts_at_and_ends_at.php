<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBookableAvailabilitiesAddStartsAtAndEndsAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table(config('rinvex.bookings.tables.bookable_availabilities'), function (Blueprint $table) {
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();
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
        Schema::table(config('rinvex.bookings.tables.bookable_availabilities'), function (Blueprint $table) {
            $table->dropColumn('starts_at');
            $table->dropColumn('ends_at');
        });
    }
}
