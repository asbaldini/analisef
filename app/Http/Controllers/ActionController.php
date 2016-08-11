<?php

namespace AnaliseF\Http\Controllers;

use Illuminate\Http\Request;

use AnaliseF\Http\Requests;

class ActionController extends Controller
{
    public function create($index)
    {
        $i = $index;

        return view('analyses.partial._action-row', compact('i'));
    }
}
