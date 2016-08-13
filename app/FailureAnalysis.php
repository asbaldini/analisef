<?php

namespace AnaliseF;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    public function saveFailureAnalysis($new_analysis, $actions)
    {
        try {
            DB::transaction(function() use ($new_analysis, $actions){
                $new_failure_analysis = $this->create($new_analysis);

                if($new_failure_analysis instanceof $this){
                    $new_failure_analysis->actions()->saveMany($actions);
                }
                else {
                    throw new Exception('Erro ao criar analise de falha');
                }
            });
            return true;
        } catch (Exception $e) {
            dd($e->getLine().') '.$e->getMessage());
            return false;
        }
    }

}