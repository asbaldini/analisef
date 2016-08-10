{!! Form::hidden('id', empty($user)?0:$user->id) !!}
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Nome', array('class' => 'col-md-4 control-label')) !!}

    <div class="col-md-6">
        {!! Form::text('name', null, array('class' => 'form-control')) !!}
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
    {!! Form::label('user', 'Usuário', array('class' => 'col-md-4 control-label')) !!}

    <div class="col-md-4">
        {!! Form::text('user', null, array('class' => 'form-control')) !!}
        @if ($errors->has('user'))
            <span class="help-block">
                <strong>{{ $errors->first('user') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {!! Form::label('password', 'Senha', array('class' => 'col-md-4 control-label')) !!}

    <div class="col-md-6">
        {!! Form::password('password', null, array('class' => 'form-control')) !!}
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('password_confirmation', 'Confirma a senha',
        array('class' => 'col-md-4 control-label')) !!}

    <div class="col-md-6">
        {!! Form::password('password_confirmation', null, array('class' => 'form-control')) !!}
    </div>
</div>

@if($is_admin)
    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
        {!! Form::label('role', 'Nível', array('class' => 'col-md-4 control-label')) !!}

        <div class="col-md-3">
            {!! Form::select(
                'role',
                $roles,
                null,
                array(
                    'class' => 'form-control'
                )
            ) !!}
            @if ($errors->has('role'))
                <span class="help-block">
                    <strong>{{ $errors->first('role') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
        {!! Form::label('status', 'Status', array('class' => 'col-md-4 control-label')) !!}

        <div class="col-md-3">
            {!! Form::select(
                'status',
                array(
                    0 => 'Pendente',
                    1 => 'Ativado'
                ),
                null,
                array(
                    'class' => 'form-control'
                )
            ) !!}
            @if ($errors->has('status'))
                <span class="help-block">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>
    </div>
@endif
@if ($errors->has('action.error'))
    <span class="alert alert-danger col-md-offset-4 col-md-4 col-md-offset-4 text-center">
        <strong>{{ $errors->first('action.error') }}</strong>
    </span>
@endif
<div class="action-box col-md-offset-4 col-md-8">
    {!! Form::submit('Salvar', array('class' => 'btn btn-sm btn-primary')) !!}
    <a href="{{ route('user.index') }}" class="btn btn-sm btn-danger">Cancelar</a>
</div>