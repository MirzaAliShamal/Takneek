<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEventsTableForRecurringFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('recurring_event');
            $table->dropColumn('recurring_type');
            $table->dropColumn('recurring_interval');
            $table->dropColumn('recurring_until');
            $table->string('recurring_appointment')->nullable()->after('max_seats');
            $table->string('unavailable_recurring_dates')->nullable()->after('recurring_appointment');
            $table->string('recurring_appointment_payments')->nullable()->after('unavailable_recurring_dates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
}
