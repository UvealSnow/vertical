<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnrolledUsersToDayLesson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('day_lesson', function (Blueprint $table) {
            $table->integer('max_users')->default(0);
            $table->integer('enrolled_users')->default(0);
        });

        Schema::table('lesson_user', function (Blueprint $table) {
            $table->integer('day_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('day_lesson', function (Blueprint $table) {
            $table->dropColumn(['max_users', 'enrolled_users']);
        });

        Schema::table('lesson_user', function (Blueprint $table) {
            $table->dropColumn('day_id');
        });
    }
}
