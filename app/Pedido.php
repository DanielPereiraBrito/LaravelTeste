<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function produtos()
    {
        // return $this->belongsToMany('App\Produto', 'pedido_produtos');
        return $this->belongsToMany('App\Item', 'pedido_produtos', 'pedido_id', 'produto_id')->withPivot('id', 'created_at','updated_at');
        /**
         * 1 - modelo do relacionamento NxN em relação ao Model que estamos implementando 
         * 2 - É a tabebela auxiliar que armazena os regstros de relacionamento
         * 3 - Representa o nome da FK da tebela mapeada pelo Model na tabela de relacionamento
         * 4 - Representa o nome da FK da tabela mapeada prlo Model utilizada no relacionamento que estamos implementando 
         */
    }
}
