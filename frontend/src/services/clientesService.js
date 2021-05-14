import { http } from './config';

export default {
    listar: () => { return http.get('/clientes') },
    gerarClientes: () => {return http.get('/gerar-clientes')},
    limpar: () => {return http.get('/limparbase')},
    deposito: (data) => {return http.put('/contas/'+data.num_conta+'/depositar', data)},
    saque: (data) => {return http.put('/contas/'+data.num_conta+'/sacar', data)},
}