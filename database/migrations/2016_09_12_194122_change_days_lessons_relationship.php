<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDaysLessonsRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->text('lesson_begins')->default('2016-09-16 00:00:00');
            $table->text('lesson_ends')->default('2016-09-16 01:00:00');
        });

        Schema::drop('day_lesson');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('lesson_begins');
            $table->dropColumn('lesson_ends');
        });

        Schema::create('day_lesson', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('day_id');
            $table->integer('lesson_id');
            $table->integer('lesson_begins');
            $table->integer('lesson_ends');
            $table->integer('max_users');
            $table->integer('enrolled_users');
        });
    }
}
