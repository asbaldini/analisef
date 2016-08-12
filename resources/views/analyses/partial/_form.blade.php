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
                    1 => 'Ativa',
                    0 => 'Pendente'
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

<div class="container-fluid panel">
    <div class="panel-body">
        <h4 class="panel-title">Açoes</h4>
        {!! Form::hidden('index', 1, array('id' => 'index')) !!}
        <div id="actions-container">
            @include('analyses.partial._action-row', array('i' => 1))
        </div>

        <div class="row">
            <button type="button" class="btn btn-default" id="bt-add-action">Adicionar ação</button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        {!! Form::submit('Salvar analise de falha', array('class' => 'btn btn-primary')) !!}
    </div>
</div>


