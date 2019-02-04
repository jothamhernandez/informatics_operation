<template>
    <div class="typeahead">
        <div class="selection-container d-flex">
            <input type="text" class="form-control" v-model="search" placeholder="search user to add" v-if="!selectedUser">
            <div class="userSelected d-flex align-items-center flex-grow-1" v-if="selectedUser">
                <p class="m-0 p-0 flex-grow-1 w-100">{{selectedUser.name}}</p>
                <input type="text" class="form-control flex-shrink-1" placeholder="employee_id" v-model="newEmployee.employee_uid">
                <input type="text" class="form-control flex-shrink-1" placeholder="position" v-model="newEmployee.position">
                <button class="btn btn-success" @click="assignEmployee">Assign</button>
            </div>
        </div>
        <div class="userList" v-if="search">
            <div v-for="user in usersList" :key="user.id" class="d-flex align-items-center">
                <p class="flex-grow-1 m-0 p-0">{{user.name}}</p>
                <button class="btn btn-success flex-shrink-1" @click="selectUser(user)">Add Employee</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        usersList: function(){
            return this.users.filter( user=>{
                return user.name.toLowerCase().includes(this.search.toLowerCase());
            })
        }
    },
    data(){
        return {
            users: [],
            search: "",
            selectedUser: null,
            newEmployee: {}
        }
    },
    mounted(){
        axios.get('/api/user').then( r => {
            this.users = r.data;
        });
    },
    methods: {
        selectUser(user){
            this.selectedUser = user;
            this.newEmployee.employee_id = user.id;
            this.search ="";
            this.$emit('select-user',user)
        },
        assignEmployee(){
            this.$emit('assign-employee', this.newEmployee);
        }
    }
}
</script>

<style>

</style>
