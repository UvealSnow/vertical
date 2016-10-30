<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->boolean('bone_injury');
            $table->boolean('muscle_injury');
            $table->boolean('heart_problems');
            $table->boolean('breathing_problems');
            $table->boolean('alergy_problems');
            $table->boolean('medicine_intake');
            $table->boolean('recent_activity');
            $table->string('referer')->nullable();
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
        Schema::drop('details');
    }
}
