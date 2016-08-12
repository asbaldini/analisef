<?php

namespace AnaliseF\Http\Controllers;

use AnaliseF\FailureAnalysis;
use AnaliseF\Helpers\Helper;
use AnaliseF\Http\Requests\AnalysisRequest;
use Illuminate\Http\Request;

use AnaliseF\Http\Requests;

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
        dd($request->all());
    }
}
