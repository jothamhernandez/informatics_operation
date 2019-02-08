<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <select name="" id="" class="form-control" v-model="center_filter">
                    <option value="">Center</option>
                    <option :value="center.id" v-for="center in centers" :key="center.id">{{center.center_name}}</option>
                </select>
            </div>
            <div class="col-3">
                <select name="" id="" class="form-control" v-model="filter_mode" @change="month_filter = ''; year_filter = ''">
                    <option value="">Filter Mode</option>
                    <option value="year">Yearly</option>
                    <option value="month">Monthly</option>
                    <option value="daily">Daily</option>
                </select>
            </div>
            <div class="col-3">
                <select name="" id="" class="form-control" v-model="year_filter" v-if="filter_mode == 'month' || filter_mode == 'daily'">
                    <option value="">Year</option>
                    <option :value="year" v-for="(year, index) in year_init" :key="year" v-if="index > 2016">{{year}}</option>
                </select>
            </div>
            <div class="col-3">
                <select name="" id="" class="form-control" v-model="month_filter" v-if="filter_mode == 'daily' && year_filter != ''">
                    <option value="">Month</option>
                    <option :value="month" v-for="month in months" :key="month">{{month}}</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12" v-for="center in centers" :key="center.id" v-if="center.id == center_filter">
                <h1 class="text-center">{{center.center_name}}</h1>
                <div class="row">
                    <div class="col-4" v-for="kpi in kpi_fields" :key="kpi" >
                        <h3 class="text-center">{{ kpi.replace(/_/g, " ").toUpperCase().replace("TARGET","") }}</h3>
                        <kpi-graph :center="center" :filter-option="filter_mode" :fields="kpi" :year_filter="year_filter" :month_filter="month_filter"></kpi-graph>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        year_init(){
            return parseInt(moment().format('YYYY'));
        }
    },
    data(){
        return {
            centers:[],
            filter_mode: 'daily',
            month_filter: 'February',
            year_filter: '2019',
            center_filter: '',
            kpi_fields: [],
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
        axios.get('/api/center').then( r=> {
            this.centers = r.data;
        });

        axios.get('/api/getColumnName/kpi_month_infos').then( r=> {
            r.data.forEach((d, index) =>{
                if(index != 0 && index != 1 && index != 2 && index != 3 && index != 11 && index != 12){
                    this.kpi_fields.push(d);
                }
            });
        })
    },
    methods:{
        getYear(){
            return parseInt(moment().format("YYYY"));
        }
    }
}
</script>

<style>

</style>
