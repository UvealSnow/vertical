<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'role_id', 'name', 'img', 'phone', 'pole_lessons', 'regular_lessons', 'pole_expire', 'regular_expire'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function details () {
        return $this->hasOne('App\Detail');
    }

    public function role () {
        return $this->belongsTo('App\Role');
    }

    public function medals () {
        return $this->belongsToMany('App\Medal');
    }

    public function lessons () {
        return $this->hasMany('App\Lesson');
    }

    public function diet () {
        return $this->hasOne('App\Diet', 'user_id');
    }

    public function diets () {
        return $this->hasOne('App\Diet', 'nutriologist_id');
    }

    public function teaches () {
        return $this->hasMany('App\Lecture', 'teacher_id');
    }

}
