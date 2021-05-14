<template>
    <div class="modal fade" tabindex="-1" id="mdMensageiro">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header alert-success" v-if="dataMsg.tipo == 'success'">
                    <h5 class="modal-title">{{dataMsg.titulo}}</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-header alert-danger" v-if="dataMsg.tipo == 'danger'">
                    <h5 class="modal-title">{{dataMsg.titulo}}</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        {{dataMsg.mensagem}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['dataMsg'],
}
</script>