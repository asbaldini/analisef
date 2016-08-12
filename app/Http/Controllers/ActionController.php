<?php

namespace AnaliseF\Http\Controllers;

use AnaliseF\Helpers\Helper;
use AnaliseF\Http\Requests;

class ActionController extends Controller
{
    public function create($index)
    {
        $i = $index;

        $combo_engineers = Helper::getComboEngineers();

        return view('analyses.partial._action-row', compact('i', 'combo_engineers'));
    }
}
