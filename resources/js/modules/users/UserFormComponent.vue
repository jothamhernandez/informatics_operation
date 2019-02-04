<template>
    <div class="container" v-if="user">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">User Details</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="Name" class="col-3">Name:</label>
                            <div class="col-9">
                                <input type="text" class="form-control" v-model="user.name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-3">E-mail:</label>
                            <div class="col-9">
                                <input type="text" class="form-control" v-model="user.email">
                            </div>
                        </div>
                        <div class="form-group row" v-if="user.isNew">
                            <label for="password" class="col-3">Password:</label>
                            <div class="col-9">
                                <input type="text" class="form-control" v-model="user.password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-3">Name:</label>
                            <div class="col-9">
                                <select name="role" id="" class="form-control" v-model="user.role">
                                    <option :value="role" v-for="role in roles" :key="role">{{role}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button class="btn btn-success btn-block" v-if="user.isNew" @click="addUser">Add User</button>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success btn-block" v-if="!user.isNew" @click="saveUser">Update User</button>
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
        user:Object
    },
    data(){
        return {
            roles: []
        }
    },
    mounted(){
        axios.get('/api/getEnum/users/role').then(r=>{
            this.roles = r.data;
        });
    },
    methods:{
        saveUser(){
            axios.put(`/api/user/${this.user.id}`, this.user).then(r => {
                this.user = null;
            }); 
        },
        addUser(){
            delete this.user.isNew;
            axios.post(`/api/user`, this.user).then(r => {
                this.$root.$emit('addedUser', r.data);
            }); 
            
        }
    }
}
</script>

<style>

</style>
