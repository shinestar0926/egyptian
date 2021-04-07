<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->text('about_us');
            $table->string('about_us_image')->default('about-us.png');
            $table->text('our_team');
            $table->string('our_team_image1')->default('image.png');
            $table->string('our_team_image2')->default('image2.png');
            $table->string('our_team_image3')->default('image2.png');
            $table->string('our_team_image4')->default('image.png');
            $table->string('partners1')->default('partner1.png');
            $table->string('partners2')->default('partner2.png');
            $table->string('partners3')->default('partner3.png');
            $table->string('partners4')->default('partner4.png');
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
        Schema::dropIfExists('about_us');
    }
}
