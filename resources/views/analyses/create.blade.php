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

@section('post-script')
    <script>
        $(document).ready(function(){
            $('#bt-add-action').click(function(){
                var index = parseInt($('#index').val());
                var novo_index = index + 1;
                var url = '/acao/criar/'+novo_index;
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data){
                        $('#actions-container').append(data);
                        $('#index').val(novo_index);
                    },
                    error: function(data){
                        alert(data);
                    }
                });
            });
        });
    </script>
@endsection