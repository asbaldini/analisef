<?php

namespace AnaliseF;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user',
        'password',
        'name',
        'role',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function failureAnalyses()
    {
        return $this->hasMany('AnaliseF\FailureAnalysis', 'user_id');
    }

    public function actions()
    {
        return $this->belongsToMany('AnaliseF\User', 'users_has_actions', 'user_id', 'action_id');
    }

    public function saveUser($input)
    {
        try {
            DB::transaction(function() use ($input){
                $user = $this->fill($input);

                if(!$user->save())
                    throw new Exception('Erro ao salvar usuário');
            });
            return true;
        } catch (Exception $e){
            return false;
        }
    }
}
