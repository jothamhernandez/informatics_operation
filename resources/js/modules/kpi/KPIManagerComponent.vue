<template>
    <div class="container-fluidjotham">
        <div class="row">
            <div class="col-12">
                KPI
                <div v-if="centers">
                    <button class="btn btn-primary" v-for="center in centers" :key="center.id" @click="getKPIInfo(center)">
                        {{center.center_name}}
                    </button>
                </div>
                <div class="row">
                    <div class="col-4" v-for="kpi in kpi_fields" :key="kpi" v-if="selectedCenter">
                        <h3 class="text-center">{{ kpi.replace(/_/g, " ").toUpperCase().replace("TARGET","") }}</h3>
                        <kpi-graph :center="selectedCenter" :filter-option="'daily'" :fields="kpi" :year_filter="year_filter" :month_filter="month_filter"></kpi-graph>
                    </div>
                </div>
                <div>
                    <button class="btn btn-success" v-if="selectedCenter && !kpi_info" data-toggle="modal" data-target="#KPI_target_form">Add</button>
                    <kpi-form :id="'KPI_target_form'" :center="selectedCenter" :period="period" :setting="'target'" v-on:submit-form="displayKPIInfo"></kpi-form>
                    <div class="card" v-if="kpi_info">
                        <div class="card-header">KPI Configuration for the Month</div>
                        <div class="body container">
                            <div class="details row">
                                <dl class="col-12 bg-primary">
                                    <dt>KPI Month</dt>
                                    <dd>{{kpi_info.kpi_month}}</dd>
                                    <dt>Business Days on this Month</dt>
                                    <dd>{{monthBusinessDays.length}}</dd>
                                    <dt>Total Number of Days</dt>
                                    <dd>{{momentDate.monthNaturalDays().length}}</dd>
                                </dl>
                                <dl class="col-4">
                                   
                                    <dt>HE Database</dt>
                                    <dd>
                                        Month Target: {{kpi_info.he_database_target}} <br>
                                        Target Per Day: {{kpi_info.he_database_target / monthBusinessDays.length }} <br>
                                        Month total Actual: {{ getTotal('he_database_actual') }}
                                    </dd>
                                    
                                    <dt>HE Head Count Target</dt>
                                    <dd>
                                        Month Target: {{kpi_info.he_head_count_target}} <br>
                                        Target Per Day: {{kpi_info.he_head_count_target / monthBusinessDays.length }} <br>
                                        Month total Actual: {{ getTotal('he_head_count_actual') }}
                                    </dd>
                                </dl>
                                <dl class="col-4">
                                    <dt>SHS Database Target</dt>
                                    <dd>
                                        Month Target: {{ kpi_info.shs_database_target }} <br>
                                        Target Per Day: {{ kpi_info.shs_database_target / monthBusinessDays.length }} <br>
                                        Month total Actual: {{ getTotal('shs_database_actual') }}
                                    </dd>
                                    
                                    
                                    <dt>SHS Head Count Target</dt>
                                    <dd>
                                        Month Target: {{kpi_info.shs_head_count_target}} <br>
                                        Target Per Day: {{kpi_info.shs_head_count_target / monthBusinessDays.length }} <br>
                                        Month total Actual: {{ getTotal('shs_head_count_actual') }}
                                    </dd>
                                    
                                </dl>
                                <dl class="col-4">
                                    <dt>ICL Revenue Target</dt>
                                    <dd>
                                        Month Target: {{kpi_info.icl_revenue_target}} <br>
                                        Target Per Day: {{kpi_info.icl_revenue_target / monthBusinessDays.length }} <br>
                                        Month total Actual: {{ getTotal('icl_revenue_actual') }}
                                    </dd>
                                    
                                    <dt>ICL Corpo Database Target</dt>
                                    <dd>
                                        Month Target: {{kpi_info.icl_corpo_database_target }} <br>
                                        Target Per Day: {{kpi_info.icl_corpo_database_target / monthBusinessDays.length }} <br>
                                        Month total Actual: {{ getTotal('icl_corpo_database_actual') }}
                                    </dd>
                                    
                                    <dt>ICL Retail Database Target</dt>
                                    <dd>
                                        Month Target: {{kpi_info.icl_retail_database_target}} <br>
                                        Target Per Day: {{kpi_info.icl_retail_database_target / monthBusinessDays.length}} <br>
                                        Month total Actual: {{ getTotal('icl_retail_database_actual') }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="card" v-if="kpi_info">
                            <div class="card-header">Daily KPI</div>
                            <div class="card-body">
                                <kpi-form :id="'KPI_Form'" :period="period" :center="selectedCenter" v-on:submit-form="addKpiEntry" :setting="'actual'"></kpi-form>
                                <button class="btn btn-primary my-3" v-if="isNoKpi" data-toggle="modal" data-target="#KPI_Form">Add KPI Entry</button>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>HE Database</th>
                                            <th>HE Head Count</th>
                                            <th>SHS Database</th>
                                            <th>SHS Head Count</th>
                                            <th>ICL Revenue</th>
                                            <th>ICL Corporate Database</th>
                                            <th>ICL Retail Database</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="kpi in daily_kpi" :key="kpi.id">
                                            <td>{{ moment(kpi.created_at).format('Do') }}</td>
                                            <td v-bind:class="{
                                                'met': analyzeResult(kpi.he_database_actual,  getDailyTarget(kpi_info.he_database_target)).hasMet,
                                                'not-met': !analyzeResult(kpi.he_database_actual,  getDailyTarget(kpi_info.he_database_target)).hasMet
                                                }">
                                                {{ kpi.he_database_actual }}
                                                <p class="small">
                                                    {{ analyzeResult(kpi.he_database_actual,  getDailyTarget(kpi_info.he_database_target)).message }}
                                                </p> 
                                            </td>
                                            <td v-bind:class="{
                                                'met': analyzeResult(kpi.he_head_count_actual,  getDailyTarget(kpi_info.he_head_count_target)).hasMet,
                                                'not-met': !analyzeResult(kpi.he_head_count_actual,  getDailyTarget(kpi_info.he_head_count_target)).hasMet 
                                                }">
                                                {{ kpi.he_head_count_actual }}
                                                <p class="small">
                                                    {{ analyzeResult(kpi.he_head_count_actual,  getDailyTarget(kpi_info.he_head_count_target)).message }}
                                                </p> 
                                            </td>
                                            <td v-bind:class="{
                                                'met': analyzeResult(kpi.shs_database_actual,  getDailyTarget(kpi_info.shs_database_target)).hasMet,
                                                'not-met': !analyzeResult(kpi.shs_database_actual,  getDailyTarget(kpi_info.shs_database_target)).hasMet
                                                }">
                                                {{ kpi.shs_database_actual }}
                                                <p class="small">
                                                    {{ analyzeResult(kpi.shs_database_actual,  getDailyTarget(kpi_info.shs_database_target)).message }}
                                                </p> 
                                            </td>
                                            <td v-bind:class="{
                                                'met': analyzeResult(kpi.he_head_count_actual,  getDailyTarget(kpi_info.he_head_count_target)).hasMet,
                                                'not-met': !analyzeResult(kpi.he_head_count_actual, getDailyTarget(kpi_info.he_head_count_target)).hasMet }">
                                                {{ kpi.shs_head_count_actual}}
                                                <p class="small">
                                                    {{ analyzeResult(kpi.he_head_count_actual,  getDailyTarget(kpi_info.he_head_count_target)).message }}
                                                </p> 
                                            </td>
                                            <td v-bind:class="{
                                                'met': analyzeResult(kpi.icl_revenue_actual,  getDailyTarget(kpi_info.icl_revenue_target)).hasMet,
                                                'not-met': !analyzeResult(kpi.icl_revenue_actual, getDailyTarget(kpi_info.icl_revenue_target)).hasMet }">
                                                {{ kpi.icl_revenue_actual }}
                                                <p class="small">
                                                    {{ analyzeResult(kpi.icl_revenue_actual,  getDailyTarget(kpi_info.icl_revenue_target)).message }}
                                                </p> 
                                            </td>
                                            <td v-bind:class="{
                                                'met': analyzeResult(kpi.icl_corpo_database_actual,  getDailyTarget(kpi_info.icl_corpo_database_target)).hasMet,
                                                'not-met': !analyzeResult(kpi.icl_corpo_database_actual, getDailyTarget(kpi_info.icl_corpo_database_target)).hasMet }">
                                                {{ kpi.icl_corpo_database_actual }}
                                                <p class="small">
                                                    {{ analyzeResult(kpi.icl_corpo_database_actual,  getDailyTarget(kpi_info.icl_corpo_database_target)).message }}
                                                </p> 
                                            </td>
                                            <td v-bind:class="{
                                                'met': analyzeResult(kpi.icl_retail_database_actual,  getDailyTarget(kpi_info.icl_retail_database_target)).hasMet,
                                                'not-met': !analyzeResult(kpi.icl_retail_database_actual, getDailyTarget(kpi_info.icl_retail_database_target)).hasMet }">
                                                {{ kpi.icl_retail_database_actual }}
                                                <p class="small">
                                                    {{ analyzeResult(kpi.icl_retail_database_actual,  getDailyTarget(kpi_info.icl_retail_database_target)).message }}
                                                </p> 
                                            </td>
                                            <td>
                                                <button class="btn btn-warning">Edit</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
    computed:{
        isNoKpi(){
            // return (this.daily_kpi && moment(this.daily_kpi[this.daily_kpi.length -1].created_at, "YYYY-MM-DD HH:mm:ss").diff(this.period) != 0);\
            return (!this.daily_kpi) ? true : moment(this.daily_kpi[this.daily_kpi.length - 1].created_at, "YYYY-MM-DD").diff(moment(this.period, "YYYY-MM-DD"));
        }
    },
    data(){
        return {
            centers: null,
            selectedCenter: null,
            kpi_info: null,
            daily_kpi: null,
            monthBusinessDays:null,
            period: null,
            momentDate: null,
            kpi_fields: [],
            year_filter: '',
            month_filter: '',
            months: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ]
        }
    },
    mounted(){
        let d = new Date();
        this.period = d.toYMD();
        console.log(this.period);
        axios.get(`/api/center`).then(r => {
            this.centers = r.data;
        });
        this.monthBusinessDays = moment(this.period, 'YYYY-MM-DD').monthBusinessDays();
        this.momentDate = moment(this.period, 'YYYY-MM-DD');
        this.year_filter = moment(this.period, 'YYYY').format('YYYY');
        // console.log(new Date().getMonth());
        
        axios.get('/api/getColumnName/kpi_month_infos').then( r=> {
            r.data.forEach((d, index) =>{
                if(index != 0 && index != 1 && index != 2 && index != 3 && index != 11 && index != 12){
                    this.kpi_fields.push(d);
                }
            });
        });

    },
    methods:{
        getKPIInfo(center){
            axios.get(`/api/kpi_month?period=${this.period}&center_id=${center.id}`).then( r=> {
                this.selectedCenter = (this.selectedCenter == center) ? null : center
                this.kpi_info = (!isEmpty(r.data) && this.selectedCenter )? r.data : null;
                axios.get(`/api/kpi_daily?period=${this.period}&center_id=${center.id}`).then( r=> {
                   
                    this.daily_kpi = (!isEmpty(r.data))? r.data : null;
                    this.month_filter = this.months[new Date().getMonth()];
                });
                 
            });
            
        },
        moment: moment,
        getTotal(properties){
            if(this.daily_kpi){
                var total = 0;
                this.daily_kpi.forEach( entry =>{
                    total += parseInt(entry[properties]) || 0;
                });
                return total;
            }
        },
        getDailyTarget(field){
            return field / this.monthBusinessDays.length;
        },
        analyzeResult(actual, target){
            var result = parseFloat(target) - parseFloat(actual);
            let message = ""
            let data = {};

            if(target == ''){
                message += "no target set for this."
                data.hasMet = true;
            } else if(actual == target){
                message += "your actual met the daily target"
                data.hasMet = true;
            } else if(actual > target){
                message += "your actual is " + Math.abs(result) + " more than the daily target";
                data.hasMet = true;
            } else {
                message += "your actual is " + Math.abs(result) + " less than the daily target"     
                data.hasMet = false;           
            }
            data.message = message;
            return data;
        },
        addKpiEntry(entry){
            if(!this.daily_kpi){
                this.daily_kpi = [];
            }
            this.daily_kpi.push(entry);
            $('#KPI_form').modal('hide');
        },
        displayKPIInfo(kpi_info){
            this.kpi_info = kpi_info;
            $('#KPI_target_form').modal('hide');
        }
    }
}
</script>

<style>
    .met{
        background-color: green;
        color: white;
    }
    .not-met {
        background-color: maroon;
        color:white;
    }
</style>
