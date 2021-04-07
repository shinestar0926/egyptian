<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsVediosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_vedios', function (Blueprint $table) {
            $table->id();
            // $table->integer('posts_id')->unsigned();
            $table->unsignedBigInteger('posts_id');

            $table->string('vedios')->nullable();
            $table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade');
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
        Schema::dropIfExists('posts_vedios');
    }
}
