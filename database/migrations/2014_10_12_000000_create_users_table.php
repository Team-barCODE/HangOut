<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('prefecture')->default('');
            $table->string('city')->default('');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('self_introduction', 500)->nullable();
            $table->tinyInteger('sex')->default(0);
            $table->string('img_name1')->default('');
            $table->string('img_name2')->default('');
            $table->string('img_name3')->default('');
            $table->datetime('birth_date')->nullable();
            $table->string('password');
            $table->tinyInteger('smoke')->default(0);
            $table->tinyInteger('alcohol')->default(0);
            $table->integer('body_height')->nullable();
            $table->tinyInteger('body_figure')->default(1);
            $table->tinyInteger('education')->nullable();
            $table->tinyInteger('housemate')->nullable();
            $table->integer('income')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
