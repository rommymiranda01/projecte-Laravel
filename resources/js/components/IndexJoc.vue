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
                            <label for="nom">Nom</label>
                            <input v-model="joc.nom" type="text" class="form-control" id="nom" placeholder="">
                        </div>
                        <div class="my-4">
                            <label for="numJugadors">Núm Jugadors</label>
                            <input v-model="joc.numJugadors" type="number" class="form-control" id="numJugadors" placeholder="">
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
                <th scope="col">Nom</th>
                <th scope="col">Num Jugadors</th>
                <th scope="col" colspan="2" class="text-center">Accion</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="j in jocs">
                <th scope="row">{{ j.id }}</th>
                <td>{{ j.nom }}</td>
                <td>{{ j.numJugadors }}</td>
                <td>
                    <button  @click="modificar=true; abrirModal(j);" class="btn btn-warning">Editar</button>
                </td>
                <td>
                    <button @click="eliminar(j.id)" class="btn btn-danger">
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
            joc:{
                nom:'',
                numJugadors:0,
            },
            id:0,
            modificar:true,
            modal:0,
            tituloModal:'',
            jocs: [],
        };
    },
    methods: {
        async listar() {
            axios.get('jocs').then(res=>{
                this.jocs = res.data;
            })
        },
        async eliminar(id) {
            const res = await axios.delete('/jocs/' + id);
            this.listar();
        },
        async guardar() {
            if(this.modificar){
                const res = await axios.put('/jocs/'+this.id, this.joc);
                // console.log(this.id);

            }else{
                const res = await axios.post('/jocs/', this.joc);
            }
            this.cerrarModal();
            this.listar();
        },
        abrirModal(data={}){
            this.modal=1;
            if(this.modificar){
                this.id=data.id;
                this.tituloModal="Edita Joc";
                this.joc.nom=data.nom;
                this.sala.numJugadors=data.numJugadors;
            }else{
                this.id=0;
                this.tituloModal="Crear Joc";
                this.joc.nom='';
                this.joc.numJugadors=0;
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
