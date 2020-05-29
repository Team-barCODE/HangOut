<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHobbyUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hobby_user', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('hobby_id')->unsigned();
            
            //外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('hobby_id')->references('id')->on('hobbies')->onDelete('cascade');
            $table->unique(['user_id', 'hobby_id'],'uq_roles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hobby_user');
    }
}
