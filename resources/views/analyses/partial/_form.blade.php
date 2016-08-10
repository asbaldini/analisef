{!! Form::hidden('id', empty($analysis)?0:$analysis->id) !!}
<div class="row">
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }} col-md-9">
        {!! Form::label('description', 'Descriçao', array('class' => 'col-md-2 control-label')) !!}

        <div class="col-md-10">
            {!! Form::textarea('description', null, array('class' => 'form-control', 'rows' => '1')) !!}
            @if ($errors->has('description'))
                <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
            @endif
        </div> <!-- .col -->
    </div><!-- .form-group -->

    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} col-md-3">
        {!! Form::label('status', 'Status', array('class' => 'col-md-3 control-label')) !!}

        <div class="col-md-9">
            {!! Form::select(
                'status',
                array(
                    0 => 'Pendente',
                    1 => 'Ativa'
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
</div>

<div class="panel panel-primary">
    <div class="panel-heading">Ações</div>
    <div class="panel-body">
        <div class="col-md-4">
            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Nome', array('class' => 'col-md-2 control-label')) !!}

                <div class="col-md-10">
                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                </div>
            </div>
        </div>
        <div class="col-md-8 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Equipamento</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Responsáveis</th>
                </thead>
            </table>
        </div>
    </div>
</div>


