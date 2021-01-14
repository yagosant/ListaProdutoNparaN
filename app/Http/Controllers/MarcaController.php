<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Marca;
use Validator;
use App\Produto;

class MarcaController extends Controller
{
    //valida se o form ta ok
    protected function validarMarca($request){
        $validator = Validator::make($request->all(), [
            "nome" => "required"
        ]);
        return $validator;
    }

    public function index(Request $request)
    {
        //filtro da pesquisa
        $qtd = $request['qtd'] ?: 5;
        $page = $request['page'] ?: 1;
        $buscar = $request['buscar'];

        //veirifca a paginacao
        Paginator::currentPageResolver(function () use ($page){
            return $page;
        });

        //verifica o resultado da pesquisa
        if($buscar){
            $marcas = Marca::where('nome','=', $buscar)->paginate($qtd);
        }else{  
            $marcas = Marca::paginate($qtd);

        }

        $marcas = $marcas->appends(Request::capture()->except('page'));
        return view('marca.index', compact('marcas'));
    }

    //funcão para chamar a view de adicionar
    public function adicionar()
    {
        $marcas = Marca::all();
        return view('marca.adicionar', compact('marcas'));
    }

    //função para salvar
    public function salvar(Request $request)
    {
        //valida o form
        $validator = $this->validarMarca($request);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $dados = $request->all();
        Marca::create($dados);

        return redirect()->route('marca.index');
    }

    //função de detalhe
    public function detalhe($id)
    {
        $marca = Marca::find($id);
        
        return view('marcas.detalhe', compact('marca')); 
    }

    //função para chamar a view de editar
    public function editar()
    {
        $marca = Marca::find($id);
        
        return view('marca.editar', compact('marca'));
    }

    //função para atualizar
    public function atualizar(Request $request, $id)
    {
        $validator = $this->validarMarca($request);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }

        $marca = Marca::find($id);
        $dados = $request->all();
        $marca->update($dados);
        
        return redirect()->route('marca.index');
    }

    //função para deletar
    public function deletar($id)
    {
        //veriica se a marca n tem produto dentro dela
        if(Produto::where('marca_id', '=', $id)->count()){
            $msg = "Não é possível excluir esta marca. Os produtos com id ( ";
            $produtos = Produto::where('marca_id', '=', $id)->get();
            foreach($produtos as $produto){
                $msg .= $produto->id." ";
            }
            $msg .= " ) estão relacionados com esta marca";

            \Session::flash('mensagem', ['msg'=>$msg]);
            return redirect()->route('marca.remover', $id);
        }
        
        Marca::find($id)->delete();
        return redirect()->route('marca.index');
    }

    //funcção para chamar a view de remover
    public function remover($id)
    {
        $marca = Marca::find($id);
        return view('marca.remover', compact('marca'));
    }

    //lista os produtos por marca
    public function produtos($id)
    {
        $marca = Marca::find($id);
        return view('marca.produtos', compact('marca'));
    }
}
