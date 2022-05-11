<template>
    <div>

        <!-- Button to Open the Modal -->
        <button @click="modificar=false; abrirModal();" type="button" class="btn btn-primary my-4">Crea</button>

        <!-- The Modal -->
        <div class="modal" :class="{mostrar: modal}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{tituloModal}}</h4>
                        <button @click="cerrarModal();"  type="button" class="close" data-dismiss="modal">
                            &times;
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="my-4">
                            <label for="numPersones">Num Persona</label>
                            <input v-model="reserva.numPersones" type="number" class="form-control" id="numPersones" placeholder="">
                        </div>
                        <div class="my-4">
                            <label for="dataReserva">Data Reserva</label>
                            <input v-model="reserva.dataReserva" type="date" class="form-control" id="dataReserva" placeholder="">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button  @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">
                            Guardar
                        </button>

                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Num Persones</th>
                <th scope="col">Data Reserves</th>
                <th scope="col" colspan="2" class="text-center">Accion</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="r in reserves">
                <th scope="row">{{ r.id }}</th>
                <td>{{ r.numPersones }}</td>
                <td>{{ r.dataReserva }}</td>
                <td>
                    <button  @click="modificar=true; abrirModal(r);" class="btn btn-warning">Editar</button>
                </td>
                <td>
                    <button @click="eliminar(r.id)" class="btn btn-danger">
                        Eliminar
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            reserva:{
                numPersones:0,
                dataReserva:'',
            },
            id:0,
            modificar:true,
            modal:0,
            tituloModal:'',
            reserves: [],
        };
    },
    methods: {
        async listar() {
            axios.get('reservas').then(res=>{
                this.reserves = res.data;
            })
        },
        async eliminar(id) {
            const res = await axios.delete('/reservas/' + id);
            this.listar();
        },
        async guardar() {
            if(this.modificar){
                const res = await axios.put('/reservas/'+this.id, this.reserva);
                // console.log(this.id);

            }else{
                const res = await axios.post('/reservas/', this.reserva);
            }
            this.cerrarModal();
            this.listar();
        },
        abrirModal(data={}){
            this.modal=1;
            if(this.modificar){
                this.id=data.id;
                this.tituloModal="Edita Reserva";
                this.reserva.numPersones=data.numPersones;
                this.reserva.dataReserva=data.dataReserva;
            }else{
                this.id=0;
                this.tituloModal="Crear Reserva";
                this.reserva.numPersones=0;
                this.reserva.dataReserva='';
            }
        },
        cerrarModal(){
            this.modal=0;
        },
    },
    created() {
        this.listar();
    },
};
</script>

<style>
.mostrar{
    display: list-item;
    opacity: 1;
    background: rgba(75, 56, 143, 0.705);
}
</style>
