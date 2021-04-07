<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostscommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postscomments', function (Blueprint $table) {
            $table->id();
            // $table->integer('posts_id')->unsigned();
            $table->unsignedBigInteger('posts_id');

            $table->integer('clients_id')->unsigned();
            $table->string('comment')->nullable();
            $table->integer('approve')->default(0);
            $table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('clients_id')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('postscomments');
    }
}
