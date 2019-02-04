<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row py-2">
                    <div class="col-3">
                        <button class="btn btn-primary btn-block" @click="$emit('add-center',{isNew:true})">Add Center</button>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" placeholder="search for center" v-model="search">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cluster</th>
                            <th>Center Manager</th>
                            <th>Center Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="center in centerList" :key="center.id">
                            <td>{{center.cluster_details.cluster_name}}</td>
                            <td>{{center.center_manager_details.name}}</td>
                            <td><a :href="`./center/${center.id}`">{{center.center_name}}</a></td>
                            <td>
                                <button class="btn btn-warning" @click="$emit('select-center', center)">Edit</button>
                                <button class="btn btn-danger" @click="deleteCenter(center)">Delete</button>
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
        centerList: function(){
            return this.centers.filter(center => {
                return center.center_name.toLowerCase().includes(this.search.toLowerCase());
            });
        }
    },
    data(){
        return {
            centers: [],
            search: ""
        }
    },
    mounted(){
        axios.get('/api/center').then( r => {
            this.centers = r.data;
        });

        this.$root.$on('updatedCenter', (center)=>{
            console.log(center);
            this.centers = this.centers.map(centerToUpdate => {
                if(center.id == centerToUpdate.id){
                    console.log('changed');
                    centerToUpdate = center;
                }
                return centerToUpdate;
            });
        });

        this.$root.$on('addedCenter', (center)=>{
            this.centers.push(center);
        });
    },
    methods:{
        deleteCenter(center){
            axios.delete(`/api/center/${center.id}`).then(r=>{
                
                this.centers.splice(this.centers.indexOf(center), 1);
                this.$emit('center-delete', center);
            });
        }
    }
}
</script>

<style>

</style>
