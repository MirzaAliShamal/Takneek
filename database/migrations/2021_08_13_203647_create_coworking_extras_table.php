<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoworkingExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coworking_extras', function (Blueprint $table) {
            $table->id();
            $table->string('coworking_id')->nullable();
            $table->string('name')->nullable();
            $table->string('duration')->nullable();
            $table->string('price')->nullable();
            $table->string('qty')->nullable();
            $table->string('desc')->nullable();
            $table->string('min_req_extra')->nullable();
            $table->boolean('status')->default(1)->comment('1. yes, 0. no');
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
        Schema::dropIfExists('coworking_extras');
    }
}
