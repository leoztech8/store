<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Category List
                        <button class="btn btn-info float-right" @click="create()">Novo</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="cat in categories" :key="cat.id">
                                <td>{{cat.name}}</td>
                                <td>{{cat.description}}</td>
                                <td>
                                    <button class="btn btn-success" @click="edit(cat.id)">Editar</button>
                                    <button class="btn btn-danger" @click="destroy(cat.id)">Excluir</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Category Create</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" v-model="category.name">
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" class="form-control" v-model="category.description">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="save()" v-if="action == 'new'">Salvar</button>
                        <button type="button" class="btn btn-primary" @click="update()" v-if="action == 'edit'">Atualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.get();
    },
    data() {
        return {
            categories: [],
            category: {
                name: '',
                description: ''
            },
            action: false
        }
    },
    methods: {
        create(){
            this.action = 'new';
            this.cleanForm();
            this.showModal();
        },
        get() {
            this.$http.get('http://spot-skeleton.test/api/categories').then(response => {
                this.categories = response.data;
            })
        },
        save() {
            const data = this.category;
            this.$http.post('http://spot-skeleton.test/api/categories', data).then(() => {
                this.get();
                this.closeModal();
                this.cleanForm();
            })
        },
        edit(id) {
            this.$http.get('http://spot-skeleton.test/api/categories/'+id+'/edit').then(response => {
                this.action = 'edit';
                const category = response.data;
                this.category.name = category.name;
                this.category.description = category.description;
                this.category.id = category.id;
                this.showModal();
            })
        },
        update() {
            const data = this.category;
            this.$http.put('http://spot-skeleton.test/api/categories/'+data.id, data).then(() => {
                this.get();
                this.closeModal();
                this.cleanForm();
            })
        },
        destroy(id) {
            this.$http.delete('http://spot-skeleton.test/api/categories/'+id).then(() => {
                this.get();
            })
        },
        cleanForm() {
            this.category.name = '';
            this.category.description = '';
            this.category.id = '';
        },
        showModal() {
            $('#categoryModal').modal('show')
        },
        closeModal() {
            $('#categoryModal').modal('hide')
        }
    }
}
</script>

<style>
</style>
