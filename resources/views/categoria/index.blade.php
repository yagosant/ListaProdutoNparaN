@extends('shared.base')
@section('content')
    <div class="panel panel-default">    
        <div class="panel-heading">Lista de Categorias</div>
        <form method="GET" action="{{route('categoria.index', 'buscar' )}}">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Digite a descrição da categoria" name="buscar">
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
                            <th>Descrição</th>
                            <th>Produtos</th>
                            <th>Ações</th>
                        </tr>
                    </thead>            
                    <tbody>            
                        @foreach($categorias as $categoria)
                            <tr>
                                <td>{{$categoria->descricao}}</td>
                                <td><a href="{{route('categoria.produtos', $categoria->id)}}">Listar Produtos</a></td>
                                <td>
                                    <a href="{{route('categoria.editar', $categoria->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a href="{{route('categoria.remover', $categoria->id)}}"><i class="glyphicon glyphicon-trash"></i></a>
                                    <a href="{{route('categoria.detalhe', $categoria->id)}}"><i class="glyphicon glyphicon-zoom-in"></i></a>
                                </td>                                
                            </tr>                         
                        @endforeach                                 
                    </tbody>
                </table> 
            </div> 
        </div>
        <div align="center" class="row">
        	{{ $categorias->links() }}
	    </div>
    </div>
    <a href="{{route('categoria.adicionar')}}"><button class="btn btn-primary">Adicionar</button></a>
@endsection