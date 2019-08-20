<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Reaction extends Migration
{
    public function up()
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->integer('movie_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('emote_id')->unsigned();
        });
        Schema::table('reactions', function(Blueprint $table) {
            $table->foreign('movie_id')
            ->references('id')
            ->on('movies')
            ->onDelete('cascade');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('emote_id')
                ->references('id')
                ->on('emotes');
            $table->unique(['movie_id', 'user_id']);
        });
    }
    public function down()
    {
        Schema::table('reactions', function (Blueprint $table) {
            $table->dropForeign('reactions_emote_id_foreign');
            $table->dropColumn('emote_id');
        });
        Schema::dropIfExists('reactions');
    }
}