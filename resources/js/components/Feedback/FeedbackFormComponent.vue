<template>
    <div class="modal fade" id="feedbackForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Feedback Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="form-label col-3">Subject</label>
                    <div class="col-9">
                        <input type="text" class="form-control" v-model="feedback.subject">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="form-label col-3">Description</label>
                    <div class="col-9">
                        <textarea name="" id="" cols="30" rows="10" class="form-control" style="resize:none" v-model="feedback.description"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="close">Close</button>
                <button type="button" class="btn btn-primary" @click="submitFeedback">Submit Feedback</button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            feedback:{
                subject:'',
                description: ''
            }
        }
    },
    methods:{
        submitFeedback(){
            axios.post('/api/feedback', this.feedback).then( r=> {
                this.feedback.subject = '';
                this.feedback.description = '';
                alert('feedback has been sent');
            });
            

            $("#feedbackForm").modal('hide');
        },
        close(){
            this.feedback.subject = '';
            this.feedback.description = '';
            $("#feedbackForm").modal('hide');
        }
    }
}
</script>

<style>

</style>
