@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="header-container">
                <h4>Análises de falha</h4>
                <a href="{{ route('analysis.create') }}" class="btn btn-primary">
                    Nova análise de falha
                </a>
            </div>
        </div><!-- .row -->

        <div class="row">
            <div class="col-md-11">

            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-sm btn-inverse">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div><!-- .row -->
        <div class="row">
            <p id="msg-error" class="alert alert-danger hidden"></p>
            <div class="table-responsive">
                @if(!empty($analyses))
                    {!! csrf_field() !!}
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th>Criador</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($analyses as $analysis)
                                <tr class="">
                                    <td>{{ $analysis->id }}</td>
                                    <td>{{ $analysis->description }}</td>
                                    <td>{{ $analysis->status }}</td>
                                    <td>{{ $analysis->user->name }}</td>
                                    <td>{{ $analysis->created_at }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="alert alert-danger">Nenhuma análise cadastrada no sistema</p>
                @endif
            </div><!-- .table-responsive -->
        </div><!-- .row -->
    </div><!-- .container -->

    <script>
        function removerUsuario(id, user){
            if(confirm('Realmente deseja remover o usuário '+user+'?')){
                var url = '/usuario/'+id;
                var status = false;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
                });
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    success: function(data){
                        if(data == 'ERROR'){
                            $('#msg-error').html('Erro ao remover usuário!');
                            $('#msg-error').removeClass('hidden');
                        }
                        else {
                            status = true;
                        }
                    },
                    error: function(data){
                        $('#msg-error').html('Erro ao remover usuário!');
                        $('#msg-error').removeClass('hidden');
                    },
                    complete: function(){
                        if(status){
                            parent.location = '/usuario';
                        }
                    }
                });
            }
        }
    </script>
@endsection