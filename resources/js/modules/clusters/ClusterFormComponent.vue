<template>
    <div class="container" v-if="cluster">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Cluster Details</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="Name" class="col-3">Name:</label>
                            <div class="col-9">
                                <input type="text" class="form-control" v-model="cluster.cluster_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cluster_manager" class="col-3">Manager:</label>
                            <div class="col-9">
                                <select name="cluster_manager" id="" class="form-control" v-model="cluster.cluster_head_id">
                                    <option :value="manager.id" v-for="manager in managers" :key="manager.id">{{manager.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button class="btn btn-success btn-block" v-if="cluster.isNew" @click="addCluster">Add Cluster</button>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success btn-block" v-if="!cluster.isNew" @click="saveCluster">Update Cluster</button>
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
        cluster: Object
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
        axios.get('/api/user?column=role&value=cluster head').then( r => {
            this.managers = r.data;
        });
    },
    methods:{
        saveCluster(){
            axios.put(`/api/cluster/${this.cluster.id}`, this.cluster).then( r => {
                this.$root.$emit('updatedCluster', r.data);
            });
        },
        addCluster(){
            delete this.cluster.isNew;
            axios.post('/api/cluster', this.cluster).then( r => {
                this.$root.$emit('addedCluster', r.data);
            });
        }
    }

}
</script>

<style>

</style>
