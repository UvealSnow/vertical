<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatabaseReset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->text('name');
            $table->text('email');
            $table->text('phone')->nullable();
            $table->text('password');
            $table->text('img');
            $table->integer('pole_lessons');
            $table->integer('regular_lessons');
            $table->text('pole_expire')->nullable();
            $table->text('regular_expire')->nullable();
            $table->text('remember_token')->nullable();
            $table->timestamps();
        });

        Schema::create('lectures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id');
            $table->integer('max_students');
            $table->text('name');
            $table->boolean('is_pole');
            $table->timestamps();
        });

        Schema::create('agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lecture_id');
            $table->text('day');
            $table->text('begins');
            $table->text('ends');
            $table->timestamps();
        });

        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agenda_id');
            $table->integer('user_id');
            $table->integer('pole_id')->nullable();
            $table->text('date');
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->timestamps();
        });

        Schema::create('medals', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('desc');
            $table->text('img');
            $table->timestamps();
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->double('amount');
            $table->integer('regular_lessons');
            $table->integer('pole_lessons');
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('desc');
            $table->double('amount');
        });

        Schema::create('medal_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medal_id');
            $table->integer('user_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
        Schema::dropIfExists('users');
        Schema::dropIfExists('lectures');
        Schema::dropIfExists('agendas');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('medals');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('transactions');

    }
}
