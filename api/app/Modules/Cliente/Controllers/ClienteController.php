<?php

namespace App\Modules\Cliente\Controllers;

use Illuminate\Http\Request;
use App\Modules\Conta\Models\Conta;
use App\Http\Controllers\Controller;
use App\Modules\Cliente\Models\Cliente;

class ClienteController extends Controller
{
    protected $model = Cliente::class;
    /**
     * Listagem geral dos clientes
     */
    public function index(){
        try{
            //traz os clientes com suas respectivas contas
            $clientes = $this->model::with(
                ['conta' => function($query){
                    $query->select('num_conta', 'saldo', 'cliente_id');
                }]
            )->orderBy('id','desc')->get();
            return response()->json($clientes, 200);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Falha ao listar registros',
                'technicalMessage' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Criar registros de clientes fake
     */
    public function gerarClientes(){
        //$clientes = \factory(\App\Modules\Cliente\Models\Cliente::class)->create();
        $clientesContas = \factory(\App\Modules\Conta\Models\Conta::class, 5)->create();
    }

}
