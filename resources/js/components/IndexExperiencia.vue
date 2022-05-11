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
                            <label for="numSala">Num Sala</label>
                            <input v-model="sala.numSala" type="number" class="form-control" id="numSala" placeholder="">
                        </div>
                        <div class="my-4">
                            <label for="salaOcupada">Sala Ocupada</label>
                            <input v-model="sala.salaOcupada" type="number" class="form-control" id="salaOcupada" placeholder="">
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
                <th scope="col">Num Sala</th>
                <th scope="col">Sala Ocupada</th>
                <th scope="col" colspan="2" class="text-center">Accion</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="s in sales">
                <th scope="row">{{ s.id }}</th>
                <td>{{ s.numSala }}</td>
                <td>{{ s.salaOcupada }}</td>
                <td>
                    <button  @click="modificar=true; abrirModal(s);" class="btn btn-warning">Editar</button>
                </td>
                <td>
                    <button @click="eliminar(s.id)" class="btn btn-danger">
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
            experiencia:{
                numSala:0,
                salaOcupada:0,
            },
            id:0,
            modificar:true,
            modal:0,
            tituloModal:'',
            experiencies: [],
        };
    },
    methods: {
        async listar() {
            axios.get('salas').then(res=>{
                this.sales = res.data;
            })
        },
        async eliminar(id) {
            const res = await axios.delete('/salas/' + id);
            this.listar();
        },
        async guardar() {
            if(this.modificar){
                const res = await axios.put('/salas/'+this.id, this.sala);
                // console.log(this.id);

            }else{
                const res = await axios.post('/salas/', this.sala);
            }
            this.cerrarModal();
            this.listar();
        },
        abrirModal(data={}){
            this.modal=1;
            if(this.modificar){
                this.id=data.id;
                this.tituloModal="Edita Experiencia";
                this.sala.numSala=data.numSala;
                this.sala.salaOcupada=data.salaOcupada;
            }else{
                this.id=0;
                this.tituloModal="Crear Experiencia";
                this.sala.numSala=1;
                this.sala.salaOcupada=1;
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
