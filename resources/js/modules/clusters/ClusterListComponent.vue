<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row py-2">
                    <div class="col-3">
                        <button class="btn btn-primary btn-block" @click="$emit('add-cluster',{isNew:true})">Add Cluster</button>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" placeholder="search for cluster" v-model="search">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cluster Head</th>
                            <th>Cluster Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="cluster in clusterList" :key="cluster.id">
                            <td>{{cluster.cluster_head_details.name}}</td>
                            <td>{{cluster.cluster_name}}</td>
                            <td>
                                <button class="btn btn-warning" @click="$emit('select-cluster', cluster)">Edit</button>
                                <button class="btn btn-danger" @click="deleteCluster(cluster)">Delete</button>
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
    computed: {
        clusterList: function(){
            return this.clusters.filter(cluster=>{
                return cluster.cluster_name.toLowerCase().includes(this.search.toLowerCase());
            })
        }
    },
    data(){
        return {
            clusters: [],
            search: ""
        }
    },
    mounted(){
        axios.get('/api/cluster').then( r => {
            this.clusters = r.data;
        });

        this.$root.$on('updatedCluster', (cluster)=>{
            console.log(cluster);
            this.clusters = this.clusters.map(clusterToUpdate => {
                if(cluster.id == clusterToUpdate.id){
                    console.log('changed');
                    clusterToUpdate = cluster;
                }
                return clusterToUpdate;
            });
        });

        this.$root.$on('addedCluster', (cluster)=>{
            this.clusters.push(cluster);
        });
    },
    methods:{
        deleteCluster(cluster){
            axios.delete(`/api/cluster/${cluster.id}`).then(r=>{
                
                this.clusters.splice(this.clusters.indexOf(cluster), 1);
                this.$emit('cluster-delete', cluster);
            });
        }
    }
}
</script>

<style>

</style>
