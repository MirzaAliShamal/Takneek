<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFildsInCoworkingsAgain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coworkings', function (Blueprint $table) {
            $table->string('extra_mandatory')->after('name')->default('no');
            $table->string('Bringing_anyone_with_you')->after('name')->default('no');
            $table->string('price_multiple_by_number')->after('name')->default('no');
            $table->string('service_on_site')->after('name')->default('no');
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
