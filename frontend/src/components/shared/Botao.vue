<template>
    <button :type="tipo" :class="estilo" @click.prevent="chamaAcaoDoPai">
        <i :class="icone"></i>
        {{rotulo}}
    </button>
</template>

<script>
export default {
    props: {
        tipo: { type: String, require:true },
        estilo: {type: String, required:true},
        rotulo: {type:String, required:true},
        icone: {type:String}
    },
    methods:{
        chamaAcaoDoPai($event, param){
            //disparando um evento para o component pai
            this.$emit('acaoBotao', param);
        }
    }
}
</script>