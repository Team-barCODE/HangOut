<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalityUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personality_user', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('personality_id')->unsigned();
            
            //外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('personality_id')->references('id')->on('personalities')->onDelete('cascade');
            $table->unique(['user_id', 'personality_id'],'uq_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personality_user');
    }
}
