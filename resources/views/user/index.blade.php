@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="header-container">
                <h4>Usuários</h4>
                <a href="{{ route('user.create') }}" class="btn btn-primary">
                    Novo usuário
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
                @if(!empty($users))
                    {!! csrf_field() !!}
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Nome</th>
                            <th>Nível</th>
                            <th>Status</th>
                            <th>Criado</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="{{ $user->getStatus()=='DESATIVADO'?
                                    'alert alert-danger':
                                    $user->getStatus()=='PENDENTE'?
                                        'alert alert-warning':
                                        ''}}">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->user }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->getRoleName() }}</td>
                                    <td>{{ $user->getStatus() }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}" class="action">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        <a href="javascript:;" class="action"
                                           onclick="removerUsuario({{ $user->id }},'{{ $user->user }}')">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="alert alert-danger">Nenhum usuário cadastrado no sistema</p>
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