<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoworkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coworkings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('location_id')->references('id')->on('locations')->constrained()->onDelete('cascade');
            $table->string('duration')->nullable();
            $table->float('price')->nullable();
            $table->integer('buffer_before_time')->nullable();
            $table->integer('buffer_after_time')->nullable();
            $table->integer('min_capacity')->nullable();
            $table->integer('max_capacity')->nullable();
            $table->boolean('bringing_anyone_with_you')->default(0);
            $table->boolean('price_multiple_by_number')->default(0);
            $table->boolean('service_on_site')->default(0);
            $table->string('recurring_appointment')->nullable();
            $table->string('unavailable_recurring_dates')->nullable();
            $table->string('recurring_appointment_payments')->nullable();
            $table->text('description')->nullable();
            $table->boolean('extra_mandatory')->default(0);
            $table->integer('min_extra')->nullable();
            $table->boolean('status')->default(1)->comment('1. Active, 0. Deactivated');
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
        Schema::dropIfExists('coworkings');
    }
}
