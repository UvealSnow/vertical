<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDayLessonRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_lesson', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('day_id');
            $table->integer('lesson_id');
            $table->integer('enrolled');
            $table->text('date');
        });

        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('desc');
            $table->integer('max_students');
            $table->boolean('use_poles');
            $table->text('begins');
            $table->text('ends');
            $table->text('teacher_id');
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
        Schema::drop('day_lesson');
    }
}
