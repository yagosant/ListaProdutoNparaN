<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\categoria;
use Validator;
use App\Produto;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    //faz a validação do form
        protected function validarCategoria($request){
        $validator = Validator::make($request->all(), [
            "descricao" => "required"
        ]);
        return $validator;
    }

    public function index(Request $request)
    {
        //quantidade na pagiancção
        $qtd = $request['qtd'] ?: 5;
        $page = $request['page'] ?: 1;
        $buscar = $request['buscar'];

        Paginator::currentPageResolver(function () use ($page){
            return $page;
        });

        //valida a busca
        if($buscar){
            $categorias = Categoria::where('descricao','=', $buscar)->paginate($qtd);
        }else{  
            $categorias = Categoria::paginate($qtd);

        }
        $categorias = $categorias->appends(Request::capture()->except('page'));
        return view('categoria.index', compact('categorias'));
    }

    //chama a view de adicionar
    public function adicionar()
    {
        $categorias = Categoria::all();
        return view('categoria.adicionar', compact('categorias'));
    }

    //faz o salvamento do registro
    public function salvar(Request $request)
    {
    $validator = $this->validarCategoria($request);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
    }
    $dados = $request->all();
    Categoria::create($dados);

    return redirect()->route('categoria.index');
    }

    //mostra os detalhes
    public function detalhe($id)
    {
        $categoria = Categoria::find($id);
        
        return view('categoria.detalhe', compact('categoria'));
    }

    //chama a view de edição
    public function edit($id)
    {
        $categoria = Categoria::find($id);    
        return view('categoria.editar', compact('categoria'));  
    }

    //faz a atualização do registro
    public function atualizar(Request $request, $id)
    {
        $validator = $this->validarCategoria($request);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }

        $categoria = Categoria::find($id);
        $dados = $request->all();
        $categoria->update($dados);
        
        return redirect()->route('categoria.index'); 
    }

    //função para deletar
    public function deletar($id)
    {
        if(DB::table('categoria_produto')->where('categoria_id', $id)->count()){
            $msg = "Não é possível excluir esta categoria. Os produtos com id ( ";
            $produtos = DB::table('categoria_produto')->where('categoria_id', $id)->get();
            foreach($produtos as $produto){
                $msg .= $produto->produto_id." ";
            }
            $msg .= " ) estão relacionados com esta categoria";
            \Session::flash('mensagem', ['msg'=>$msg]);
            return redirect()->route('categoria.remover', $id);
        }

        Categoria::find($id)->delete();
        return redirect()->route('categoria.index');
    }

    //função que chama a view para remover
    public function remover($id)
    {
        $categoria = Categoria::find($id);
        return view('categoria.remover', compact('categoria'));
    }

    public function produtos($id)
    {
        $categoria = Categoria::find($id);
        return view('categoria.produtos', compact('categoria'));
    }
}
