<?php

namespace App\Modules\Cliente\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['id','nome','tipo_conta','cpf','cnpj'];

    public function conta(){
        return $this->hasMany('\App\Modules\Conta\Models\Conta', 'cliente_id');
    }
}
