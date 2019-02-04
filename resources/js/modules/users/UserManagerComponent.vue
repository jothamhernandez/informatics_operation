<template>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <user-list v-on:user-select="selectUser" v-on:add-user="addUser"></user-list>
            </div>
            <div class="col-4">
                <user-form :user="selectedUser"></user-form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            selectedUser: null,
        }
    },
    mounted(){
        this.$root.$on('addedUser',(data)=>{
            this.selectedUser = null;
        });
    },
    methods: {
        selectUser(user){
            this.selectedUser = (this.selectedUser == user) ? null : user;
        },
        addUser(){
            this.selectedUser = {
                isNew: true
            }
        }
    }
}
</script>

<style>

</style>
