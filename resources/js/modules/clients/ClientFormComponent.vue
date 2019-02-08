<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-success" data-toggle="modal" data-target="#addClient">Add Client</button>
            </div>
            <div class="col-12">
                <div class="modal fade" id="addClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Client Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form">
                            <div class="form-group row">
                                <label for="first_name" class="col-3 col-form-label text-right">First Name:</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" placeholder="First Name" v-model="client.first_name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="first_name" class="col-3 col-form-label text-right">Last Name:</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" placeholder="Last Name" v-model="client.last_name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="first_name" class="col-3 col-form-label text-right">Middle Name:</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" placeholder="Middle Name" v-model="client.middle_name">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="first_name" class="col-3 col-form-label text-right">Birthdate:</label>
                                <div class="col-9">
                                    <input type="date" class="form-control" placeholder="birthdate" v-model="client.birthdate">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="gender" class="col-3 col-form-label text-right">Gender: </label>
                                <div class="col-9">
                                    <div class="form-check">
                                        <input name="gender" class="form-check-input" type="radio" value="male" v-model="client.gender">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="gender" class="form-check-input" type="radio" value="female" v-model="client.gender">
                                        <label class="form-check-label" for="defaultCheck2">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="first_name" class="col-3 col-form-label text-right">Contact No:</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" placeholder="Contact No" v-model="client.contact">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="first_name" class="col-3 col-form-label text-right">E-mail:</label>
                                <div class="col-9">
                                    <input type="email" class="form-control" placeholder="Email" v-model="client.email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="first_name" class="col-3 col-form-label text-right">Previous School:</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" placeholder="Previous School" v-model="client.school">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="first_name" class="col-3 col-form-label text-right">Client Type:</label>
                                <div class="col-9">
                                    <select name="" id="" class="form-control" v-model="client.client_type">
                                        <option value="">------</option>
                                        <option :value="client_type" v-for="client_type in client_types" :key="client_type">{{client_type}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="first_name" class="col-3 col-form-label text-right">Source of Awareness:</label>
                                <div class="col-9">
                                    <select name="" id="" class="form-control" v-model="client.source_of_awareness">
                                        <option value="">------</option>
                                        <option :value="source" v-for="source in source_of_awareness" :key="source">{{source}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="addRecord">Add Client Record</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            client_types:[],
            source_of_awareness: [],
            client: {}
        }
    },
    mounted(){


        axios.get('/api/getEnum/clients/client_type').then( r=>{
            this.client_types = r.data;
        });

        axios.get('/api/getEnum/clients/source_of_awareness').then( r=> {
            this.source_of_awareness = r.data;
        })
    },
    methods: {
        addRecord(){
            axios.post('/api/client', this.client).then( r=> {
                console.log(r.data);
                if(r.data.id){
                    $('#addClient').modal('hide');
                    this.$root.$emit('added-client', r.data);
                }
            });
        }
    }
}
</script>

<style>

</style>
