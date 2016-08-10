@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $action_title }}</div>
                    <div class="panel-body">
                        {!! Form::open(array('route' => 'analysis.store', 'role' => 'form', 'class' => 'form-horizontal')) !!}
                        @include('analyses.partial._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection