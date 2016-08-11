<div class="row">
    <div class="col-md-2">
        <div class="form-group{{ $errors->has('actions.'.$i.'.name') ? ' has-error' : '' }}">
            {!! Form::label('actions.'.$i.'.name', 'Nome', array('class' => 'control-label')) !!}
            {!! Form::text('actions.'.$i.'.name', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group{{ $errors->has('actions.'.$i.'.description') ? ' has-error' : '' }}">
            {!! Form::label('actions.'.$i.'.description', 'Descrição', array('class' => 'control-label')) !!}
            {!! Form::text('actions.'.$i.'.description', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group{{ $errors->has('actions.'.$i.'.equipment') ? ' has-error' : '' }}">
            {!! Form::label('actions.'.$i.'.equipment', 'Equipamento', array('class' => 'control-label')) !!}
            {!! Form::text('actions.'.$i.'.equipment', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group{{ $errors->has('actions.'.$i.'.begin') ? ' has-error' : '' }}">
            {!! Form::label('actions.'.$i.'.begin', 'Início', array('class' => 'control-label')) !!}
            {!! Form::text('actions.'.$i.'.begin', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group{{ $errors->has('actions.'.$i.'.deadline') ? ' has-error' : '' }}">
            {!! Form::label('actions.'.$i.'.deadline', 'Fim', array('class' => 'control-label')) !!}
            {!! Form::text('actions.'.$i.'.deadline', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group{{ $errors->has('actions.'.$i.'.engineers[]') ? ' has-error' : '' }}">
            {!! Form::label('actions.'.$i.'.engineers[]', 'Responsáveis', array('class' => 'control-label')) !!}
            {!! Form::text('actions.'.$i.'.engineers[]', null, array('class' => 'form-control')) !!}
        </div>
    </div>
</div>