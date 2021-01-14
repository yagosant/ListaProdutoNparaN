@extends('shared.base')
@section('content')
    <div class="panel panel-default">    
        <div class="panel-heading">Lista de Marcas</div>
        <form method="GET" action="{{route('marca.index', 'buscar' )}}">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Digite o nome da marca" name="buscar">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Pesquisar</button>
                    </span>
                </div>
            </div>
        </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Produtos</th>
                            <th>Ações</th>
                        </tr>
                    </thead>            
                    <tbody>            
                        @foreach($marcas as $marca)
                            <tr>
                                <td>{{$marca->nome}}</td>
                                <td><a href="{{route('marca.produtos', $marca->id)}}">Listar Produtos</a></td>
                                <td>
                                    <a href="{{route('marca.editar', $marca->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a href="{{route('marca.remover', $marca->id)}}"><i class="glyphicon glyphicon-trash"></i></a>
                                    <a href="{{route('marca.detalhe', $marca->id)}}"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                </td>                                
                            </tr>                         
                        @endforeach                                 
                    </tbody>
                </table> 
            </div> 
        </div>
        <div align="center" class="row">
        	{{ $marcas->links() }}
	    </div>
    </div>
    <a href="{{route('marca.adicionar')}}"><button class="btn btn-primary">Adicionar</button></a>
@endsection