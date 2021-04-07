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
            $table->integer('category_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->string('default_image')->nullable();
            $table->string('default_vedios')->nullable();
           // $table->string('slideshow')->nullable();
            $table->string('checked')->nullable();
            $table->string('vediochecked')->nullable();
            $table->string('impchecked')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
