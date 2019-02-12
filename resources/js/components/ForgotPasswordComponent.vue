<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="form-group row">
                    <label for="newPassword" class="form-label col-3">New Password</label>
                    <div class="col-9">
                        <input type="password" class="form-control" placeholder="New Password" v-model="reset.password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="retypePassword" class="form-label col-3">Retype Password</label>
                    <div class="col-9">
                        <input type="password" class="form-control" placeholder="Retype Password" v-model="reset.password_confirmation">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <button class="btn btn-success" @click="resetPassword">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            user: null,
            reset: {
                email:"",
                password: "",
                password_confirmation: "",
                // token: document.head.querySelector('meta[name="csrf-token"]').content
            }
        }
    },
    mounted(){
        axios.get('/api/loggedUser').then( r => {
            this.user = r.data;
        });
    },
    methods:{
        resetPassword(){
            this.reset.email = this.user.email;
            axios.post('/password/reset', this.reset).then( r=> {
                console.log(r);
            })
        }
    }
}
</script>

<style>

</style>
