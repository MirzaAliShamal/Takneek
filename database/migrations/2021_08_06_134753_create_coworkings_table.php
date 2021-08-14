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
            $table->string('text')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('duration')->nullable();
            $table->float('price')->nullable();
            $table->integer('buffer_time')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('reserver_space')->nullable();
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
