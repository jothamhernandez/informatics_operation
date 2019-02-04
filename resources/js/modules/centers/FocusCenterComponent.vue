<template>
    <div class="container" v-if="center">
        <div class="row d-flex">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Center Information</div>
                    <div class="card-body">
                        <dl>
                            <dt>Center Name</dt>
                            <dd>{{center.center_name}}</dd>
                            <dt>Cluster Details</dt>
                            <dd v-if="center.cluster_details">
                                Cluster Name - {{center.cluster_details.cluster_name}} <br>
                                Cluster Head - {{center.cluster_details.cluster_head_details.name}}
                            </dd>
                            <dt>Manager Details</dt>
                            <dd v-if="center.center_manager_details">
                                Center Manager - {{center.center_manager_details.name}}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="col flex-grow-1 w-100">
                <employee-list :employees="center.employees"></employee-list>
                <user-typeahead v-on:select-user="toAddUser" v-on:assign-employee="assignEmployee"></user-typeahead>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            center: null,
            users: [],
            selectedUser: null,
        }
    },
    mounted(){
        let path = window.location.pathname.split('/');
        let center_id = path[path.length - 1];
        axios.get(`/api/center/${center_id}`).then( r => {
            this.center = r.data;
        });
    },
    methods: {
        toAddUser(user){
            this.selectedUser = user;
        },
        assignEmployee(newEmployee){
            newEmployee.center_id = this.center.id;
            axios.post('/api/employee', newEmployee).then(r=>{
                this.center.employees.push(r.data);
            })
        }
    }
}
</script>

<style>

</style>
