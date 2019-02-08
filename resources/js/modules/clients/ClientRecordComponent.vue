<template>
    <div class="container" v-if="client">
        <div class="row">
            <div class="col-12">
                <div class="modal fade" id="viewRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View Client Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h3>Personal Information</h3>
                            <div class="row">
                                <div class="col-4">
                                    <dl>
                                        <dt>First Name</dt>
                                        <dd>{{client.first_name}}</dd>
                                    </dl>
                                </div>
                                <div class="col-4">
                                    <dl>
                                        <dt>Middle Name</dt>
                                        <dd>{{client.middle_name}}</dd>
                                    </dl>
                                </div>
                                <div class="col-4">
                                    <dl>
                                        <dt>Last Name</dt>
                                        <dd>{{client.last_name}}</dd>
                                    </dl>
                                </div>
                                <div class="col-6">
                                    <dl>
                                        <dt>Birthdate</dt>
                                        <dd>({{moment().diff(client.birthdate,'years',false)}})
                                            {{moment(client.birthdate, "YYYY-MM-DD").format('LL')}}</dd>
                                    </dl>
                                </div>
                                <div class="col-6">
                                    <dl>
                                        <dt>Gender</dt>
                                        <dd>{{client.gender}}</dd>
                                    </dl>
                                </div>
                                <div class="col-12">
                                    <dl>
                                        <dt>Previous School Attended</dt>
                                        <dd>{{client.school}}</dd>
                                    </dl>
                                </div>
                            </div>
                            <h3>Contact Information</h3>
                            <div class="row">
                                <div class="col-6">
                                    <dl>
                                        <dt>Contact No</dt>
                                        <dd>{{client.contact}}</dd>
                                    </dl>
                                </div>
                                <div class="col-6">
                                    <dl>
                                        <dt>Email</dt>
                                        <dd>{{client.email}}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    data(){
        return{
            client: {}
        }
    },
    mounted(){
        this.$root.$on('view-client-record', this.viewRecord );
    },
    methods:{
        viewRecord(client){
            console.log(client);
            this.client = client;
        },
        moment: moment
    }
}
</script>

<style>

</style>
