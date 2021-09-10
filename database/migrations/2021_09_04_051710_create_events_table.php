<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('title');
            $table->text('detail');
            $table->string('date');
            $table->string('time');
            $table->string('host');
            $table->integer('max_seats');
            $table->boolean('recurring_event')->default(0);
            $table->string('recurring_type');
            $table->string('recurring_interval');
            $table->string('recurring_until');
            $table->float('price');
            $table->integer('max_allowed_booking');
            $table->integer('no_of_guests');
            $table->string('location');
            $table->string('lat')->nullable();
            $table->string('lang')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('events');
    }
}
