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
            $table->string('text');
            $table->text('description');
            $table->string('location');
            $table->string('duration');
            $table->float('price');
            $table->integer('buffer_time');
            $table->integer('quantity');
            $table->integer('reserver_space');
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
