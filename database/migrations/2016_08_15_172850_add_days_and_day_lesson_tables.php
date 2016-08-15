<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDaysAndDayLessonTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('day_lesson', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('day_id');
            $table->integer('lesson_id');
            $table->integer('lesson_begins');
            $table->integer('lesson_ends');
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
        Schema::drop('days');
        Schema::drop('day_lesson');
    }
}
