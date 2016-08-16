<?php

namespace AnaliseF;

use Illuminate\Database\Eloquent\Collection;
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
        'email',
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

    protected $roles_names = array(
        'superadmin' => 'ROOT',
        'admin' => 'Admin',
        'engineer' => 'Engenheiro'
    );

    protected $casts = array(
        'status' => 'boolean'
    );

    public function failureAnalyses()
    {
        return $this->hasMany('AnaliseF\FailureAnalysis', 'user_id');
    }

    public function actions()
    {
        return $this->belongsToMany('AnaliseF\User', 'users_has_actions', 'user_id', 'action_id');
    }

    public function getRoleName()
    {
        return $this->roles_names[$this->role];
    }

    public function getStatus()
    {
        if(!is_null($this->deleted_at)){
            return 'DESATIVADO';
        }
        else {
            if($this->status){
                return 'ATIVADO';
            }

            return 'PENDENTE';
        }
    }

    public function getCreatedAtAttribute($value)
    {
        $date = date_create($value);
        return date_format($date, 'd/m/Y');
    }

    public function getUsers($filter = array())
    {
        $users = new Collection();

        if(!empty($filter)){

        }
        else {
            $users = $this->all();
        }

        return $users;
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

    public function updateUser($input, $id)
    {
        try {
            DB::transaction(function() use ($input, $id){
                $user = $this->find($id)->fill($input);

                if(!$user->update())
                    throw new Exception('Erro ao salvar usuário');
            });
            return true;
        } catch (Exception $e){
            return false;
        }
    }

    public function deleteUser($id)
    {
        try {
            DB::transaction(function() use($id){
                $user = $this->find($id);

                if(!$user->delete())
                    throw new Exception('Erro ao deletar usuário');
            });
            return true;
        } catch (Exception $e){
            return false;
        }
    }
}
