<template>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <cluster-list v-on:select-cluster="selectCluster" v-on:add-cluster="addCluster"></cluster-list>
            </div>
            <div class="col-4">
                <cluster-form :cluster="selectedCluster"></cluster-form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            selectedCluster: null,
        }
    },
    mounted(){
        this.$root.$on('addedCluster',(data)=>{
            this.selectedCluster = null;
        });
        this.$root.$on('updatedCluster', (data)=>{
            this.selectedCluster = null;
        });
    },
    methods: {
        selectCluster(cluster){
            this.selectedCluster = (this.selectedCluster == cluster) ? null : cluster;
        },
        addCluster(){
            this.selectedCluster = {
                isNew: true
            }
        }
    }
}
</script>

<style>

</style>
