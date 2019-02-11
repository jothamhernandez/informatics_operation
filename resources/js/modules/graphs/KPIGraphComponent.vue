<script>
import { Line, mixins } from 'vue-chartjs';
import { timeout } from 'q';

export default {
    extends: Line,
    mixins: [mixins.reactiveData],
    computed:{
    },
    watch:{
        year_filter: {
            handler: function(newval,oldval){
                console.log(newval);
            }
        },
        labelList: {
            handler: function(newval, oldval){
                this.chartData.labels = newval;
                // if(!this._data._chart){
                    
                    this.renderChart(this.chartData, this.options);
                // } else {
                    // this._data._chart.update()
                // }
            }
        },
        datasets: {
            handler: function(newval, oldval){
                this.chartData.datasets = newval;
                // if(!this._data._chart){
                
                this.renderChart(this.chartData, this.options);
                // } else {
                    // this._data._chart.update()
                // }
            }
        },
        filterOption: {
            handler: function(old, newval){
                if(old != newval){
                    this.labelList = this.labels();
                    this.datasets = [];
                    this.datasets.push(this.getDataSet('actual'));
                    this.datasets.push(this.getDataSet('target'));
                }
            }
        },
        month_filter: {
            handler: function(newval, oldval){
                var labelList = []
                console.log(newval);
                if(this.filterOption == 'daily'){
                    
                    this.month_days = moment(`${this.month_filter} 1 ${this.year_filter}`, 'LL').monthNaturalDays();
                    this.month_days.forEach(d => {
                        labelList.push(d.date());
                    });
                }
                this.labelList = labelList;
                this.datasets = []
                this.datasets.push(this.getDataSet('actual'));
                this.datasets.push(this.getDataSet('target'));
            }
        }
    },
    data(){
        return {
            
            month_days: [],
            chartData: {
                labels: [],
                datasets: []
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            },
            centerData: null,
            labelList: [],
            datasets: []
        }
    },
    props: ['center','filterOption','fields','year_filter','month_filter'],
    mounted(){

        axios.get(`http://localhost:8000/api/overseer?query=kpi&center_id=${this.center.id}`).then( r=> {  
            this.centerData = r.data;
            this.labelList = this.labels();
            if(this.filterOption == 'daily'){
                var labelList = []
                this.month_days = moment(`${this.month_filter} 1 ${this.year_filter}`, 'LL').monthNaturalDays();
                this.month_days.forEach(d => {
                    labelList.push(d.date());
                });
                this.labelList = labelList;
                
            }
            
            this.datasets.push(this.getDataSet('actual'));
            this.datasets.push(this.getDataSet('target'));
        })
    },
    methods: {
        getDataSet(setting){
            
            var dataSet = {};
            dataSet.data  = [];
            this.month_days.forEach((e,index)=>{
                this.month_days[index].data = 0;
            });
            var days = []
            if(setting == 'actual'){
                for(var year in this.centerData.centerKpi){
                    for(var month in this.centerData.centerKpi[year]){
                        var data = {};
                        this.centerData.centerKpi[year][month].forEach( d => {
                            for(var prop in d){
                                if(prop == this.fields.replace('target','actual')){
                                    if(!data[prop]){
                                        data[prop] = 0;
                                    }
                                    data[prop] += parseFloat(d[prop]);
                                    
                                }
                            }
                            // delete data.created_at;
                            delete data.center_id;
                            delete data.prepared_by;
                            delete data.updated_at;
                            delete data.id;
                            if(this.filterOption == 'daily'){
                                
                                this.month_days.forEach((e,index) =>{
                                    
                                    if(e.format('YYYY-MM-DD') == moment(d.created_at, 'YYYY-MM-DD').format('YYYY-MM-DD')){
                                     
                                        delete data.created_at;
                                        for(var a in data){
                                            // dataSet.data.push(data[a]);
                                            this.month_days[index].data = data[a];
                                            console.log(this.month_days[index]);
                                        } 
                                    } else {
                                        
                                    }
                                })

                            }
                        })
                        if(this.filterOption == 'month'){
                            for(var a in data){
                                dataSet.data.push(data[a]);
                            }    
                        }
                    }
                    
                    

                    if(this.filterOption == 'year'){
                        for(var a in data){
                            dataSet.data.push(data[a]);
                        }    
                    }
                }   

                if(this.filterOption == 'daily'){
                    var highest = 0;
                    this.month_days.forEach((e,i)=>{
                        if(highest < this.month_days[i].data){
                            highest = this.month_days[i].data;
                        }
                        dataSet.data.push(highest);
                    });
                }
                dataSet.label = "Actual";
                dataSet.borderColor= "#00438D"; 
            }

            if(setting == 'target'){
                for(var year in this.centerData.centerKpiTarget){
                    for(var month in this.centerData.centerKpiTarget[year]){
                        var data = {};
                        this.centerData.centerKpiTarget[year][month].forEach( d => {
                            for(var prop in d){
                                if(prop == this.fields){
                                    if(!data[prop]){
                                        data[prop] = 0;
                                    }
                                    data[prop] += parseFloat(d[prop]);
                                }
                            }
                            delete data.created_at;
                            delete data.center_id;
                            delete data.manager_id;
                            delete data.updated_at;
                            
                            delete data.id;

                            if(this.filterOption == 'daily'){
                                
                                this.month_days.forEach(e =>{
                                    
                                    if(e.format('YYYY-MM') == moment(d.kpi_month, 'YYYY-MM').format('YYYY-MM')){
                                        
                                        delete data.created_at;
                                        for(var a in data){
                                            dataSet.data.push(data[a]);
                                        } 
                                    } else {
                                        if(e.format('YYYY-MM') == moment(d.kpi_month, 'YYYY-MM').format('YYYY-MM')){
                                            dataSet.data.push(data[this.fields]);
                                        }
                                    }
                                })
                                   
                            }
                            delete data.kpi_month;
                        })
                        if(this.filterOption == 'month'){
                            for(var a in data){
                                dataSet.data.push(data[a]);
                            }    
                        }
                    }
                    
                    if(this.filterOption == 'year'){
                        for(var a in data){
                            dataSet.data.push(data[a]);
                        }    
                    }
                }
                dataSet.label = "Target";
                dataSet.borderColor= "#008D0B";
            }
            return dataSet;
        },
        labels(){
            var labels = [];
            var data = this.centerData.centerKpi;
            if(this.centerData && this.filterOption == 'year'){
                for(var year in data){
                    labels.push(year);
                }
            }
            if(this.centerData && this.filterOption == 'month'){
                for(var year in data){
                    for(var month in data[year]){
                        labels.push(month);
                    }
                }
            }
            if(this.centerData && this.filterOption == 'daily'){
                for(var year in data){
                    for(var month in data[year]){
                        data[year][month].forEach( d=> {
                            labels.push(moment(d.created_at, "YYYY-MM-DD").format('YYYY-MM-DD'));
                        })
                    }
                }
            }
            return labels;
        }
    }
}
</script>

<style>

</style>
