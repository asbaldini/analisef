<?php

namespace AnaliseF\Http\Controllers;

use AnaliseF\Action;
use AnaliseF\FailureAnalysis;
use AnaliseF\Helpers\Helper;
use AnaliseF\Http\Requests\AnalysisRequest;
use Illuminate\Http\Request;

use AnaliseF\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AnalysisController extends Controller
{
    private $analysisModel;

    public function __construct(FailureAnalysis $analysis)
    {
        $this->analysisModel = $analysis;
    }

    public function index()
    {
        $analyses = $this->analysisModel->getFailureAnalyses();

        return view('analyses.index', compact('analyses'));
    }

    public function create()
    {
        $action_title = 'Nova análise de falha';

        $combo_engineers = Helper::getComboEngineers();

        return view('analyses.create', compact('action_title', 'combo_engineers'));
    }

    public function store(AnalysisRequest $request)
    {
        // SERVICE LAYER

        // Create a array with only the necessary field
        $analysis_fields = array('description', 'status');
        $new_analysis = array_intersect_key($request->all(), array_flip($analysis_fields));
        // Set the logged user as the analysis user
        $new_analysis['user_id'] = Auth::user()->id;

        // Create a array to push the Action models
        $actions = array();
        $action_fields = array('name', 'description', 'equipment', 'begin', 'deadline', 'engineers');
        foreach($request->get('actions') as $action){
            //Create a Action model and push to the array
            $action_model = new Action(array_intersect_key($action, array_flip($action_fields)));
            array_push($actions, $action_model);
        }
        // .SERVICE LAYER

        // If save the failure analysis, redirect to the analysis index.
        if($this->analysisModel->saveFailureAnalysis($new_analysis, $actions)){
            return redirect()->route('analysis.index');
        }
        // Else redirect back with error.
        else {
            return redirect()->back()->withErrors(array('action.error' => 'Erro ao salvar análise de falha'));
        }
    }
}
