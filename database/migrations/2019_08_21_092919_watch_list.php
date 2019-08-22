<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WatchList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watch_lists', function (Blueprint $table) {
            $table->integer('movie_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });
        Schema::table('watch_lists', function(Blueprint $table) {
            $table->foreign('movie_id')
            ->references('id')
            ->on('movies')
            ->onDelete('cascade');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->unique(['movie_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropIfExists('watch_lists');
    }
}
