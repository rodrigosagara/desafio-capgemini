<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api/v1'], function(){
    Route::get('gerar-clientes', '\App\Modules\Cliente\Controllers\ClienteController@gerarClientes');
    Route::put('contas/{n_conta}/sacar', '\App\Modules\Conta\Controllers\ContaController@sacar');
    Route::put('contas/{n_conta}/depositar', '\App\Modules\Conta\Controllers\ContaController@depositar');
    Route::resource('clientes', '\App\Modules\Cliente\Controllers\ClienteController');
});