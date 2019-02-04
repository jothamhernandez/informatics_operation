<template>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <center-list v-on:add-center="addCenter" v-on:select-center="selectCenter"></center-list>
            </div>
            <div class="col-4">
                <center-form :center="selectedCenter"></center-form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            selectedCenter: null
        }
    },
    mounted(){
        this.$root.$on('addedCenter',(data)=>{
            this.selectedCenter = null;
        });
    },
    methods: {
        addCenter(center){
            this.selectedCenter = center;
        },
        selectCenter(center){
            this.selectedCenter = (this.selectedCenter != center) ? center : null;
        }
    }
}
</script>

<style>

</style>
