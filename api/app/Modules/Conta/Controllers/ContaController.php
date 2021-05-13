<?php

namespace App\Modules\Conta\Controllers;

use Illuminate\Http\Request;
use App\Modules\Conta\Models\Conta;
use App\Http\Controllers\Controller;

class ContaController extends Controller
{
    protected $model = Conta::class;
    /**
     * Metodo que realiza o deposito na conta selecionada
     */
    public function depositar(Request $request, $n_conta)
    {
        try {
            $conta = $this->model::where('num_conta', $n_conta)->first();
            //deposita o valor a conta corrente
            $conta->saldo += $request->valor_deposito;
            $this->model::where('num_conta', $n_conta)->update([
                'saldo' => $conta->saldo
            ]);
            return response()->json($conta, 200);
        } catch (\Excaption $e) {
            return response()->json([
                'success'=>false,
                'message'=>'Falha ao depositar',
                'technicalMessage'=>$e->getMessage()
            ], 400);
        }
    }

    /**
     * Metodo que realiza o saque na conta selecionada
     */
    public function sacar(Request $request, $n_conta)
    {
        try {
            $conta = $this->model::where('num_conta', $n_conta)->first();
            if($conta->saldo >= $request->valor_saque){
                //saca o valor da conta corrente
                $conta->saldo -= $request->valor_saque;
                $this->model::where('num_conta', $n_conta)->update([
                    'saldo' => $conta->saldo
                ]);
            } else {
                return response()->json([
                    'success'=>false,
                    'message'=>'O valor do saque não pode ser maior que o valor do saldo!',
                    'saldo_disponivel'=>$conta->saldo
                ], 400);
            }
            return response()->json($conta, 200);
        } catch (\Excaption $e) {
            return response()->json([
                'success'=>false,
                'message'=>'Falha ao sacar',
                'technicalMessage'=>$e->getMessage()
            ], 400);
        }
    }
}
