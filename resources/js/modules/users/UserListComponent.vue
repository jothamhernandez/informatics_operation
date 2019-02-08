<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row py-2">
                    <div class="col-3">
                        <button class="btn btn-primary btn-block" @click="$emit('add-user')">Add User</button>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" placeholder="search for user" v-model="search">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Employee ID</th>
                            <th>E-Mail</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in userList" :key="user.id">
                            <td>{{user.name}}</td>
                            <td>{{user.employee_uid}}</td>
                            <td>{{user.email}}</td>
                            <td>{{user.role}}</td>
                            <td>
                                <button class="btn btn-warning btn-block" @click="selectUser(user)">Edit</button>
                                <button class="btn btn-danger btn-block" @click="deleteUser(user)">Delete</button>
                                <button class="btn btn-success btn-block" @click="resetPassword(user)">Reset Password</button>
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
        userList: function(){
            return this.users.filter(user=>{
                return user.name.toLowerCase().includes(this.search.toLowerCase()) || user.email.toLowerCase().includes(this.search.toLowerCase()) || user.role.toLowerCase().includes(this.search.toLowerCase());
            });
        }
    },
    data(){
        return {
            users: [],
            search: ""
        }
    },
    mounted(){
        axios.get('/api/user').then(r=>{
            this.users = r.data;
        });
        this.$root.$on('addedUser', (user)=>{
            console.log(user);
            this.users.push(user);
        });
    },
    methods: {
        selectUser(user){
            this.$emit('user-select', user);
        },
        deleteUser(user){
            axios.delete(`/api/user/${user.id}`).then(r=>{
                
                this.users.splice(this.users.indexOf(user), 1);
                this.$emit('user-delete', user);
            });
        },
        resetPassword(user){
            axios.post('/password/email', {email: user.email, _token: window.axios.defaults.headers.common['X-CSRF-TOKEN']}).then( d=>{
                console.log(d);
            })
        }
    }
}
</script>

<style>

</style>
