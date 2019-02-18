<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Subject</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="feedback in feedbacks" :key="feedback.id">
                            <td>{{feedback.user_details.name}}</td>
                            <td><div class="btn btn-link" @click="selectFeedback(feedback)">{{feedback.subject}}</div></td>
                            <td>{{feedback.created_at}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" v-if="selectedFeedback">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{selectedFeedback.user_details.name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3>{{selectedFeedback.subject}}</h3>
                        <p>{{selectedFeedback.description}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
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
            feedbacks: [],
            selectedFeedback: null
        }
    },
    mounted(){
        axios.get('/api/feedback').then( r=>{
            this.feedbacks = r.data;
        })
    },
    methods: {
        selectFeedback(feedback){
            this.selectedFeedback = feedback;
            $('#feedback').modal('show');
        }
    }
}
</script>

<style>

</style>
