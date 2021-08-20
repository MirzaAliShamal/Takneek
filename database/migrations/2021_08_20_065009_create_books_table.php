<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('image');
            $table->string('name');
            $table->integer('qty');
            $table->foreignId('book_author_id')->references('id')->on('book_authors')->constrained()->onDelete('cascade');
            $table->foreignId('book_category_id')->references('id')->on('book_categories')->constrained()->onDelete('cascade');
            $table->float('price');
            $table->enum('condition', ['1', '2', '3'])->default('1')->comment('1.New, 2.Good, 3.Damaged');
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
        Schema::dropIfExists('books');
    }
}
