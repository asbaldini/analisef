<?php

namespace AnaliseF;

use Illuminate\Database\Eloquent\Model;

class FailureAnalysis extends Model
{
    protected $table = 'failure_analyses';

    protected $fillable = [
        'description',
        'status',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo('AnaliseF\User', 'user_id');
    }

    public function actions()
    {
        return $this->hasMany('AnaliseF\Action', 'failure_analysis_id');
    }
}
