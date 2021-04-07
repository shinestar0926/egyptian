<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplaycommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replaycomments', function (Blueprint $table) {
            $table->id();
            // $table->integer('postscomments_id')->unsigned();
            // $table->integer('clients_id')->unsigned();
            $table->unsignedBigInteger('postscomments_id');
            $table->unsignedInteger('clients_id');
            $table->string('replaytext')->nullable();
            $table->integer('approve')->default(0);
            $table->foreign('clients_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('postscomments_id')->references('id')->on('postscomments')->onDelete('cascade');
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
        Schema::dropIfExists('replaycomments');
    }
}
