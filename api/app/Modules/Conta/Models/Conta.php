<?php

namespace App\Modules\Conta\Models;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $fillable = ['id','num_conta','saldo','cliente_id'];
}
