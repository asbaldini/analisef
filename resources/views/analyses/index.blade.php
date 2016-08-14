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
                                <tr class="analysis">
                                    <td>{{ $analysis->id }}</td>
                                    <td>{{ $analysis->description }}</td>
                                    <td>{{ $analysis->status }}</td>
                                    <td>{{ $analysis->user->name }}</td>
                                    <td>{{ $analysis->created_at }}</td>
                                    <td>
                                        <a href="javascript:;" class="action show-actions">
                                            <i class="fa fa-cogs" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('analysis.edit', $analysis->id) }}" class="action">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr class="data-actions hidden">
                                    <td colspan="6">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <th></th>
                                                    <th>Nome</th>
                                                    <th>Descrição</th>
                                                    <th>Responsaveis</th>
                                                    <th>Equipamento</th>
                                                    <th>Inicio</th>
                                                    <th>Prazo</th>
                                                    <th>Açoes</th>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $action_index = 1;
                                                ?>
                                                    @foreach($analysis->actions as $action)
                                                        <tr>
                                                            <td>{{ $action_index }}</td>
                                                            <td>{{ $action->name }}</td>
                                                            <td>{{ $action->description }}</td>
                                                            <td></td>
                                                            <td>{{ $action->equipment }}</td>
                                                            <td>{{ $action->begin }}</td>
                                                            <td>{{ $action->deadline }}</td>
                                                            <td>
                                                                <a href="" class="action">
                                                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                            $action_index++;
                                                        ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
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
@endsection
@section('post-script')
    <script>
        $(document).ready(function(){
            $(".show-actions").each(function(){
                $(this).click(function(){
                    var tr_analysis = $(this).closest(".analysis");
                    var tr_action = tr_analysis.next(".data-actions");
                    var is_open = false;
                    if(!tr_action.hasClass("hidden")){
                        is_open = true;
                    }
                    if(is_open){
                        tr_action.addClass("hidden");
                    }
                    else {
                        $(".data-actions").each(function(){
                            if(!$(this).hasClass("hidden")){
                                $(this).addClass("hidden");
                            }
                        });

                        tr_action.removeClass("hidden");
                    }
                });
            });
        });
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