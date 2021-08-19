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
            $table->foreignId('coworking_id')->references('id')->on('coworkings')->constrained()->onDelete('cascade');
            $table->string('extra_name')->nullable();
            $table->integer('extra_duration')->nullable();
            $table->float('extra_price')->nullable();
            $table->integer('extra_qty')->nullable();
            $table->text('extra_description')->nullable();
            $table->boolean('status')->default(1)->comment('1. Active, 0. Disabled');
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
