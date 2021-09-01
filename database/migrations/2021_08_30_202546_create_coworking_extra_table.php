<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoworkingExtraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coworking_extra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coworking_id')->references('id')->on('coworkings')->constrained()->onDelete('cascade');
            $table->foreignId('extra_id')->references('id')->on('extras')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coworking_extra');
    }
}
