<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {

        Schema::create('diets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nutriologist_id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('file')->nullable();
            $table->timestamps();
        });

        Schema::create('meals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('diet_id');
            $table->string('time');
            $table->string('body');
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
        Schema::dropIfExists('diets');
        Schema::dropIfExists('meals');
    }
}
