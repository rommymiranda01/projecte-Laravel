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
                        <h4 class="modal-title">{{ tituloModal }}</h4>
                        <button @click="cerrarModal();" type="button" class="close" data-dismiss="modal">
                            &times;
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form enctype="multipart/form-data">
                            <div class="my-4">
                                <label for="nom">Nom</label>
                                <input v-model="joc.nom" type="text" class="form-control" id="nom" placeholder="">
                            </div>
                            <div class="my-4">
                                <label for="durada">Durada</label>
                                <input v-model="joc.durada" type="number" class="form-control" id="durada"
                                       placeholder="">
                            </div>
                            <div class="my-4">
                                <label for="foto">Foto</label>
                                <input type="file" @change="obtenirImatge" class="form-control" id="foto" placeholder="">
                            </div>

                            <div class="my-4">
                                <label for="foto">Sala</label>
                                <select name="idSala" id="idSala" class="form-select" v-model="joc.id_sala">
                                    <option value="" selected></option>
                                    <option v-for="sala in sales" :key="sala.nomSala" :value="sala.id">{{sala.id + " - "+sala.nomSala}}</option>
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">
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
                <th scope="col">Durada</th>
                <th scope="col">Foto</th>
                <th scope="col">Sala</th>
                <th scope="col" colspan="2" class="text-center">Accion</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="j in jocs">
                <th scope="row">{{ j.id }}</th>
                <td>{{ j.nom }}</td>
                <td>{{ j.durada }}</td>
                <td>{{ j.foto }}</td>
                <td>{{ j.id_sala }}</td>
                <td>
                    <button @click="modificar=true; abrirModal(j);" class="btn btn-warning">Editar</button>
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
            jocs: [],
            sales: [],
            joc: {
                nom: '',
                durada: '',
                foto: '',
                id_sala: '',
            },
            id: 0,
            modificar: true,
            modal: 0,
            tituloModal: '',
        };
    },
    methods: {
        async obtenirImatge(e){
            let file = e.target.file[0];
            this.joc.foto = file;
            console.log(file);
        },
        async listar() {
            // axios.get('jocs').then(res => {
            //     this.jocs = res.data;
            // })
            axios.get('/jocs')
                .then(res => {

                    res.data.forEach(element => {

                        let joc = {id: null, nom: '', durada: '', foto: '', id_sala: ''}
                        joc.id = element.id;
                        joc.nom = element.nom;
                        joc.durada = element.durada;
                        joc.id_sala = element.id_sala;
                        axios.get(`/salas/${element.id_sala}`)
                            .then(res => {
                                joc.id_sala = res.data.id_sala;
                            })
                        this.jocs.push(joc);
                    })
                })

            axios.get('/salas')
                .then(res => {
                    this.sales = res.data
                })
        },
        async eliminar(id) {
            const res = await axios.delete('/jocs/' + id);
            this.listar();
        },
        async guardar() {
            if (this.modificar) {
                const res = await axios.put('/jocs/' + this.id, this.joc);
            } else {
                const res = await axios.post('/jocs/', this.joc);
            }
            this.cerrarModal();
            this.listar();
        },
        abrirModal(data = {}) {
            this.modal = 1;
            if (this.modificar) {
                this.id = data.id;
                this.tituloModal = "Edita Joc";
                this.joc.nom = data.nom;
                this.joc.durada = data.durada;
                this.joc.foto = data.foto;
                this.joc.id_sala = data.id_sala;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Joc";
                this.joc.nom = '';
                this.joc.durada = '';
                this.joc.foto = '';
                this.joc.id_sala = '';
            }
        },
        cerrarModal() {
            this.modal = 0;
        },
    },
    created() {
        this.listar();
    },
};
</script>

<style>
.mostrar {
    display: list-item;
    opacity: 1;
    background: rgba(75, 56, 143, 0.705);
}
</style>
