<?php

namespace AnaliseF;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function failureAnalyses()
    {
        return $this->hasMany('AnaliseF\FailureAnalysis', 'user_id');
    }

    public function actions()
    {
        return $this->belongsToMany('AnaliseF\User', 'users_has_actions', 'user_id', 'action_id');
    }
}
