export class ContaSelecionada {
    constructor(num_conta, valor_deposito, valor_saque){
        this.num_conta = num_conta;
        this.valor_deposito = valor_deposito;
        this.valor_saque = valor_saque;
    }

    setDeposito(valor){
        this.valor_deposito = valor;
    }
    setSaque(valor){
        this.valor_saque = valor;
    }
    setConta(num){
        this.num_conta = num;
    }
}