<?php

namespace AnaliseF;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FailureAnalysis extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'status',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('AnaliseF\User', 'user_id');
    }

    public function actions()
    {
        return $this->hasMany('AnaliseF\Action', 'failure_analysis_id');
    }

    public function getFailureAnalyses($filter = array())
    {
        $analyses = new Collection();

        if(!empty($filter)){

        }
        else {
            $analyses = $this->all();
        }

        return $analyses;
    }

}
