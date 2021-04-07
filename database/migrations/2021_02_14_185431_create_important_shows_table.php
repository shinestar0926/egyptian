<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportantShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('important_shows', function (Blueprint $table) {
            $table->id();
            // $table->integer('posts_id')->unsigned();
            $table->unsignedBigInteger('posts_id');
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
        Schema::dropIfExists('important_shows');
    }
}
