<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('post_type');
            $table->string('title');
            $table->longText('content');
            $table->foreignId('post_category_id')->references('id')->on('post_categories')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->string('poll_type')->nullable();
            $table->text('poll_question')->nullable();
            $table->integer('poll_option_count')->nullable();
            $table->string('job_type')->nullable();
            $table->integer('job_salary')->nullable();
            $table->text('job_requirements')->nullable();
            $table->text('job_technologies')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
