<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //permite criar registros em massa
    protected $fillable = [
        "descricao"
    ];

    //relacionamento n para n
    public function produtos(){
        return $this->belongsToMany('App\Produto', 'categoria_produto');
    }

}
