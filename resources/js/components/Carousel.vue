<template>
    <div class="row d-flex justify-content-center">
        <div class="card col-sm-4" style="width: 18rem; margin: 10px; " v-for="(item, index) in jocs" :key="index">
            <h5 class="card-header">{{ item.id + " - " + item.nom }}</h5>
            <h5 class="card-body">{{ "Durada: "+item.durada + " min"}}</h5>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            jocs: [],
        };
    },
    methods: {
        async listar() {
            axios.get('/jocs')
                .then(res => {
                    console.log(res.data)
                    this.jocs = res.data;
                })
        }
    },
    created() {
        this.listar();
    },
};
</script>

<style>

</style>
