<template>
    <div class="container" v-if="center">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Center Details</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="Name" class="col-3">Name:</label>
                            <div class="col-9">
                                <input type="text" class="form-control" v-model="center.center_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cluster" class="col-3">Cluster:</label>
                            <div class="col-9">
                                <select name="cluster" id="" class="form-control" v-model="center.cluster_id">
                                    <option :value="cluster.id" v-for="cluster in clusters" :key="cluster.id">{{cluster.cluster_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="center_manager" class="col-3">Manager:</label>
                            <div class="col-9">
                                <select name="center_manager" id="" class="form-control" v-model="center.center_manager">
                                    <option :value="manager.id" v-for="manager in managers" :key="manager.id">{{manager.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button class="btn btn-success btn-block" v-if="center.isNew" @click="addCenter">Add Center</button>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success btn-block" v-if="!center.isNew" @click="saveCenter">Update Center</button>
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
    props:{
        center: Object
    },
    data(){
        return {
            clusters: [],
            managers: []
        }
    },
    mounted(){
        axios.get('/api/cluster').then( r => {
            this.clusters = r.data;
        });
        axios.get('/api/user?column=role&value=center manager').then( r => {
            this.managers = r.data;
        });
    },
    methods:{
        saveCenter(){
            axios.put(`/api/center/${this.center.id}`, this.center).then( r => {
                this.$root.$emit('updatedCenter', r.data);
            });
        },
        addCenter(){
            delete this.center.isNew;
            axios.post('/api/center', this.center).then( r => {
                this.$root.$emit('addedCenter', r.data);
            });
        }
    }

}
</script>

<style>

</style>
