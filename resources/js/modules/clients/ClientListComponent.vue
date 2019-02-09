<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Client Lists {{clients.length}}</h1>
            </div>
            <div class="col-12">
                <input type="text" class="form-control" v-model="search">
            </div>
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Client Type</th>
                            <th>Source of Awareness</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="client in clientList" :key="client.id">
                            <td>{{client.first_name}}</td>
                            <td>{{client.last_name}}</td>
                            <td>{{client.client_type}}</td>
                            <td>{{client.source_of_awareness}}</td>
                            <td>
                                <button class="btn btn-success" data-toggle="modal" data-target="#viewRecord" @click="selectClient(client)">View Record</button>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed:{
        clientList(){
            return this.clients.filter( client => {
                return client.first_name.toLowerCase().includes(this.search.toLowerCase()) || client.last_name.toLowerCase().includes(this.search.toLowerCase());
            });
        }
    },
    data(){
        return {
            clients: [],
            search: ''
        }
    },
    mounted(){
        axios.get('/api/client').then( r=> {
            this.clients = r.data;
        });

        this.$root.$on('added-client', this.addClientToList);
    },
    methods:{
        addClientToList(client){
            this.clients.push(client);
        },
        selectClient(client){
            $('#viewRecord').modal('show');
            this.$root.$emit('view-client-record', client);
        }
    }
}
</script>

<style>

</style>
