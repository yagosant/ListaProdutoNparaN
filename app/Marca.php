<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    //permite adicionar em massa
    protected $fillable = [
        "nome"
    ];

    //faasz o relacionamento 1 para n
    public function produtos(){
        return $this->hasMany('App\Produto', 'marca_id');
    }

}
