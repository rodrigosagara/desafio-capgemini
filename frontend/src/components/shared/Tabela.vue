<template>
    <div>
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>CPF</th>
                    <th>Número da Conta</th>
                    <th>Membro desde</th>
                    <th>Saldo Atual</th>
                    <th colspan="2">Opções</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cliente in listaClientes">
                    <td>{{ cliente.nome }}</td>
                    <td>{{ cliente.cpf }}</td>
                    <td>{{ cliente.conta[0].num_conta }}</td>
                    <td>{{ formatData(cliente.created_at) }}</td>
                    <td>
                        <strong class="alert-info">R$ {{ cliente.conta[0].saldo }}</strong>
                    </td>
                    <td>
                        <Botao  
                            tipo="button"
                            estilo="btn btn-outline-success"
                            rotulo="Depositar"
                            icone="fa fa-plus"
                            @acaoBotao="carregaFormDepositar(cliente.conta[0])" />
                    </td>
                    <td>
                        <Botao 
                            tipo="button"
                            estilo="btn btn-outline-danger"
                            rotulo="Sacar"
                            icone="fa fa-minus"
                            @acaoBotao="carregaFormSacar(cliente.conta[0])" />
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="modal fade" tabindex="-1" id="mdDepositar">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Realizar Deposito na conta: {{contaSelecionada.num_conta}}</h5>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                             <h5>Entre com o valor</h5>
                            <form>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">R$</span>
                                    </div>
                                    <input type="number" class="form-control" min="0" v-model="contaSelecionada.valor_deposito" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <Botao
                                        tipo="button"
                                        estilo="btn btn-success"
                                        rotulo="Depositar"
                                        @acaoBotao="realizarDeposito(contaSelecionada)"
                                        v-show="contaSelecionada.valor_deposito" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="mdSacar">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Realizar Saque da conta: {{contaSelecionada.num_conta}}</h5>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <h5>Entre com o valor</h5>
                            <form>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">R$</span>
                                    </div>
                                    <input type="number" class="form-control" min="0" v-model="contaSelecionada.valor_saque" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <Botao
                                        tipo="button"
                                        estilo="btn btn-danger"
                                        rotulo="Sacar"
                                        @acaoBotao="realizarSaque(contaSelecionada)"
                                        v-show="contaSelecionada.valor_saque" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Botao from './Botao';
import clientesService from '../../services/clientesService';
import { ContaSelecionada } from '../../models/ContaSelecionada';
import { MensageiroModel } from '../../models/MensageiroModel';
import $ from 'jquery/dist/jquery';
import jQuery from 'jquery/dist/jquery';

export default {
    components:{
        Botao
    },
    props: ['listaClientes'],
    data(){
        return{
            contaSelecionada: new ContaSelecionada(),
            mensageiroModel: new MensageiroModel()
        }
    },
    methods:{
        formatData(data){
            let get = data.substring(0,10);
            let pos = get.split('-');
            let new_data = `${pos[2]}/${pos[1]}/${pos[0]}`
            return new_data;
        },
        carregaFormDepositar(conta){
            this.contaSelecionada.setConta(conta.num_conta);
            $('#mdDepositar').modal('show');
        },
        realizarDeposito(conta){
            clientesService.deposito(conta).then(res => {
                $('#mdDepositar').modal('hide');
                this.contaSelecionada = new ContaSelecionada();
                this.mensageiroModel.setTitulo('Sucesso');
                this.mensageiroModel.setMensagem('Deposito Realizado com Sucesso');
                this.mensageiroModel.setTipo('success');
                this.$emit('recarregarClientes', this.mensageiroModel);
            }, err =>{
                $('#mdDepositar').modal('hide');
                this.contaSelecionada = new ContaSelecionada();
                this.mensageiroModel.setTitulo('Falha');
                this.mensageiroModel.setMensagem(err.response.data.message);
                this.mensageiroModel.setTipo('danger');
                this.$emit('recarregarClientes', this.mensageiroModel);
            });
        },
        carregaFormSacar(conta){
            this.contaSelecionada.setConta(conta.num_conta);
            $('#mdSacar').modal('show');
        },
        realizarSaque(conta){
            clientesService.saque(conta).then(res => {
                $('#mdSacar').modal('hide');
                this.contaSelecionada = new ContaSelecionada();
                this.mensageiroModel.setTitulo('Sucesso');
                this.mensageiroModel.setMensagem('Saque Realizado com Sucesso');
                this.mensageiroModel.setTipo('success');
                this.$emit('recarregarClientes', this.mensageiroModel);
            }, err =>{
                $('#mdSacar').modal('hide');
                this.contaSelecionada = new ContaSelecionada();
                this.mensageiroModel.setTitulo('Falha');
                this.mensageiroModel.setMensagem(err.response.data.message);
                this.mensageiroModel.setTipo('danger');
                this.$emit('recarregarClientes', this.mensageiroModel);
            });
        },
    }
}
</script>

<style>

</style>