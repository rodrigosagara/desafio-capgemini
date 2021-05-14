export class MensageiroModel {
    constructor(titulo, mensagem, tipo){
        this.titulo = titulo;
        this.mensagem = mensagem;
        this.tipo = tipo;
    }

    setTitulo(valor){
        this.titulo = valor;
    }
    setTipo(valor){
        this.tipo = valor;
    }
    setMensagem(valor){
        this.mensagem = valor;
    }
}