<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->morphs('bookingable');
            $table->boolean('bring_anyone')->default(0);
            $table->string('date');
            $table->string('time');
            $table->boolean('recurring_booking')->default(0);
            $table->string('recurring_type');
            $table->string('recurring_interval');
            $table->string('recurring_until');
            $table->float('service_price')->default(0);
            $table->float('extra_price')->default(0);
            $table->float('total_price')->default(0);
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
        Schema::dropIfExists('bookings');
    }
}
