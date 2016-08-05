<?php

namespace AnaliseF;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = [
        'name',
        'description',
        'equipment',
        'begin',
        'deadline',
        'deadline2',
        'deadline2_requested',
        'deadline2_authorized',
        'failure_analysis_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function failureAnalysis()
    {
        return $this->belongsTo('AnaliseF\FailureAnalysis', 'failure_analysis_id');
    }

    public function users()
    {
        return $this->belongsToMany('AnaliseF\User', 'users_has_actions', 'action_id', 'user_id');
    }

}
