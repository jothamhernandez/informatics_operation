<template>
    <div class="modal fade" :id="id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">KPI FORM</div>
                <div class="modal-body">
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="HE_database" class="col-3">HE Database</label>
                                    <input type="text" class="form-control col-9" :placeholder="`HE Database Count ${setting}`" v-model="kpi_entry[`he_database_${setting}`]">
                                </div>
                                <div class="form-group row">
                                    <label for="HE_head_count" class="col-3">HE Head Count</label>
                                    <input type="text" class="form-control col-9" :placeholder="`HE Head Count ${setting}`" v-model="kpi_entry[`he_head_count_${setting}`]">
                                </div>
                                <div class="form-group row">
                                    <label for="SHS_database" class="col-3">SHS Database</label>
                                    <input type="text" class="form-control col-9" :placeholder="`SHS Database Count ${setting}`" v-model="kpi_entry[`shs_database_${setting}`]">
                                </div>
                                <div class="form-group row">
                                    <label for="SHS_head_count" class="col-3">SHS Head Count</label>
                                    <input type="text" class="form-control col-9" :placeholder="`SHS Head Count ${setting}`" v-model="kpi_entry[`shs_head_count_${setting}`]">
                                </div>
                                <div class="form-group row">
                                    <label for="ICL_revenue" class="col-3">ICL Revenue</label>
                                    <input type="text" class="form-control col-9" :placeholder="`ICL Revenue ${setting}`" v-model="kpi_entry[`icl_revenue_${setting}`]">
                                </div>
                                <div class="form-group row">
                                    <label for="ICL_corporate_database" class="col-3">ICL Corporate Database</label>
                                    <input type="text" class="form-control col-9" :placeholder="`ICL Corporate Database ${setting}`" v-model="kpi_entry[`icl_corpo_database_${setting}`]">
                                </div>
                                <div class="form-group row">
                                    <label for="ICL_retail_database" class="col-3">ICL Retail Database</label>
                                    <input type="text" class="form-control col-9" :placeholder="`ICL Retail Database ${setting}`" v-model="kpi_entry[`icl_retail_database_${setting}`]">
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <button class="btn btn-success" @click="submitKPI">Add KPI Entry</button>
                                    </div>
                                </div>
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
        id: String,
        period: String,
        center: Object,
        setting: String 
    },
    data(){
        return {
            kpi_entry: {},
        }
    },
    mounted(){
        
    },
    methods: {
        submitKPI(){
            
            this.kpi_entry.center_id = this.center.id;
            if(this.setting == 'actual'){
                axios.post('/api/kpi_daily', this.kpi_entry).then( r=> {
                    this.$emit('submit-form', r.data);
                });
            }

            if(this.setting == 'target'){
                this.kpi_entry.kpi_month = this.period;
                axios.post('/api/kpi_month', this.kpi_entry).then( r=> {
                    this.$emit('submit-form', r.data);
                });
            }
            
        }
    }
}
</script>

<style>

</style>
