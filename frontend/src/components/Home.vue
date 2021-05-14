<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron" id="quadro">
                <h1>Desafio: Banco Capgemini</h1>
                <h5 class="alert alert-info">Após configurar o ambiente siga essas operações:</h5>
                <ul>
                    <li>Clique em Gerar Cliente para criar os dados</li>
                    <li>Após carregar a lista verifique o saldo de cada conta</li>
                    <li>Clique em Depositar em um registro para adicionar um valor a conta</li>
                    <li>Ou clique em Sacar em um registro para retirar um valor da conta</li>
                    <li>Se desejar, clique em Limpar Base de Dados para zerar as informações</li>
                </ul>
                <h5>Desenvolvidor por: Rodrigo Santos &lt;rodrigo.sagara8@gmail.com&gt; </h5>
                <h5>Github: <a href="https://github.com/rodrigosagara" target="_blank">https://github.com/rodrigosagara</a></h5>
            </div>
            <div class="container">
                <Botao 
                    tipo="button" 
                    estilo="btn btn-primary mb-3" 
                    rotulo="Gerar Clientes" 
                    icone="fa fa-users"
                    @acaoBotao="gerarClientes" />
                <Botao
                    tipo="button"
                    estilo="btn btn-outline-danger mb-3"
                    rotulo="Limpar Base de Dados"
                    icone="fa fa-database"
                    @acaoBotao="limparBase" />
                <Mensageiro :data-msg="mensageiroModel" />
                <Tabela
                    :lista-clientes="clientes"
                    @recarregarClientes="listarClientes" />
            </div>
        </div>
    </div>
</template>

<script>
import clientesService from '../services/clientesService';
import Botao from './shared/Botao.vue';
import Mensageiro from './shared/Mensageiro.vue';
import Tabela from './shared/Tabela.vue';
import { MensageiroModel } from '../models/MensageiroModel';
import $ from 'jquery/dist/jquery';
import jQuery from 'jquery/dist/jquery';


export default {
    components: {
        Botao,
        Mensageiro,
        Tabela
    },
    data(){
        return {
            clientes: {},
            mensageiroModel: new MensageiroModel()
        }
    },
    mounted(){
        clientesService.listar().then(res => this.clientes = res.data, err => {
            this.mensageiroModel.setTitulo('Falha');
            this.mensageiroModel.setMensagem(err),
            this.mensageiroModel.setTipo('danger');
            $('#mdMensageiro').modal('show');
        });
    },
    methods:{
        /**
         * acao gerar clientes
         */
        gerarClientes(){
            clientesService.gerarClientes().then(res => {
                this.mensageiroModel.setTitulo('Sucesso');
                this.mensageiroModel.setMensagem(res.data.message),
                this.mensageiroModel.setTipo('success');
                this.listarClientes();
                $('#mdMensageiro').modal('show');
            }, err => {
                this.mensageiroModel.setTitulo('Falha');
                this.mensageiroModel.setMensagem(err),
                this.mensageiroModel.setTipo('danger');
                this.listarClientes();
                $('#mdMensageiro').modal('show');
            });
        },
        listarClientes(param){
            clientesService.listar().then(res => {
                this.clientes = res.data;
                if(param){
                    this.mensageiroModel = param;
                }
                $('#mdMensageiro').modal('show');
            }, err => {
                this.mensageiroModel.setTitulo('Falha');
                this.mensageiroModel.setMensagem(err),
                this.mensageiroModel.setTipo('danger');
                $('#mdMensageiro').modal('show');
            });
        },
        limparBase(){
            clientesService.limpar().then(res => {
                this.mensageiroModel.setTitulo("Sucesso");
                this.mensageiroModel.setMensagem(res.data.message);
                this.mensageiroModel.setTipo('success');
                this.listarClientes();
                $('#mdMensageiro').modal('show');
            }, err => {
                this.mensageiroModel.setTitulo('Falha');
                this.mensageiroModel.setMensagem(err),
                this.mensageiroModel.setTipo('danger');
                $('#mdMensageiro').modal('show');
            });
        }
    }
    
}
</script>

<style scoped>
    #quadro {
        margin-top: -70px !important;
        padding-bottom: 1px !important;
    }

    @media(min-width: 320px){
        #quadro{
            margin-top: -25px !important;
            padding-bottom: 1px !important;
        }
    }
</style>