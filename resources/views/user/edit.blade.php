@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $action_title }}</div>
                    <div class="panel-body">
                        {!! Form::model($user, array('route' => array('user.update', $user->id), 'role' => 'form',
                            'class' => 'form-horizontal', 'method' => 'PUT')) !!}
                            @include('user.partial._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection