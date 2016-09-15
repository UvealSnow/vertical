<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPoleLessons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('pole_lessons')->nullable();
            $table->date('lesson_expire')->nullable();
            $table->date('pole_expire')->nullable();
        });

        Schema::dropIfExists('package_user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pole_lessons');
            $table->dropColumn('lesson_expire');
            $table->dropColumn('pole_expire');
        });
    }
}
