<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('image')->default('default.png');
            $table->double('number_grams', 50, 2);
            $table->double('thickness', 50, 2);
            $table->string('karat');
            $table->string('weight');
            $table->string('manufacturer');
            $table->string('design');
            $table->double('diameter', 50, 2)->nullable();
            $table->integer('fees')->default(1);
            $table->integer('cashs')->default(1);
            $table->string('height');
            $table->string('width');
            $table->string('depth');
    
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
