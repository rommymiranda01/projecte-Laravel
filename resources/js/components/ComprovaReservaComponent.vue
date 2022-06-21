<template>
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1>Llista de reserves</h1>
        </div>
        <div class="d-flex justify-content-center">
            <table class="table">
                <thead class="table-dark">
                <tr>
                    <td>ID</td>
                    <td>Nom</td>
                    <td>Correu</td>
                    <td>Telefon</td>
                    <td>Pais</td>
                    <td>Data</td>
                    <td>Estat de la reserva</td>
                    <td>Accion</td>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in reserves" :key="index" v-if="item.accept === 0">
                    <td>{{item.id}}</td>
                    <td>{{item.nom}}</td>
                    <td>{{item.correu}}</td>
                    <td>{{item.telefon}}</td>
                    <td>{{item.pais}}</td>
                    <td>{{item.data}}</td>
                    <td>Estat pendent</td>
                    <td>
                        <button class="btn btn-danger btn-sm"
                                @click="denegarReserva(item, index)">Denegar
                        </button>
                        <button class="btn btn-warning btn-sm"
                                @click="acceptReserva(item)">Acceptar
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {

            reserves: [],

        }
    },

    created() {
        axios.get('/reservas')
            .then(res => {
                res.data.forEach(element => {
                    let reserva = {id: null, nom: '', correu: '', telefon: '', pais:'', data: '', id_joc: '', accept: null}
                    reserva.id = element.id;
                    reserva.nom = element.nom;
                    reserva.correu = element.correu;
                    reserva.telefon = element.telefon;
                    reserva.pais = element.pais;
                    reserva.data = element.data;
                    reserva.id_joc = element.id_joc;
                    reserva.accept = element.accept;
                    this.reserves.push(reserva);
                })
            })
    },

    methods: {

        denegarReserva(reserva, index){
            const confirmacio = confirm(`Eliminar reserva ${reserva.id}`);
            if(confirmacio){
                axios.delete(`/reservas/${reserva.id}`)
                    .then(()=> {
                        this.reserves.splice(index, 1);
                    })
            }
        },

        acceptReserva(reserva){
            const params = {accept: true}

            axios.put(`/reservas/${reserva.id}`,params)
                .then(res => {
                    const index = this.reserves.findIndex(item => item.id === reserva.id);
                    this.reserves[index].accept = res.data.accept;
                })


        }

    }
}
</script>

