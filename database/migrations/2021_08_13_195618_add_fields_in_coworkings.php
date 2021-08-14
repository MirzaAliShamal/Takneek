<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInCoworkings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coworkings', function (Blueprint $table) {
            $table->string('name')->after('id')->nullable();
            $table->string('buffer_before_time')->after('id')->nullable();
            $table->string('buffer_after_time')->after('id')->nullable();
            $table->string('min_capacity')->after('id')->nullable();
            $table->string('max_capacity')->after('id')->nullable();
            $table->string('recurring_appointment')->after('id')->nullable();
            $table->string('first_img')->after('id')->nullable();
            $table->string('total_extra')->after('id')->nullable();
            $table->string('req_extra')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coworkings', function (Blueprint $table) {
            //
        });
    }
}
