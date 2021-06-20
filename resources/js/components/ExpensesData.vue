<template>
    <div>
        <div class="card-header">Expenses tracker</div>
        <div class="card-body">            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="expensesYears">Year</label>
                </div>
                <select class="custom-select" id="expensesYears" v-model="selected_year">
                    <option :value="year" v-for="period,year in expenses_periods" >
                        {{ year }}
                    </option>
                </select>
            </div>
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="expensesMonths">Months</label>
                </div>
                <select class="custom-select" id="expensesMonths" v-model="selected_month">
                    <option selected value="null">Choose...</option>
                    <option v-for="data in selected_year_periods" :value="data.month_id">
                        {{ data.period }}
                    </option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        properties: null,
    },
    mounted() {
        // bad practice to mutate property, so I'm using date variable instead
        this.properties_mutated = JSON.parse(this.properties);
       
        this.expenses_periods = this.properties_mutated.expenses_periods;
        this.setPeriodForSelectedYear();   
    },

    watch: {
        selected_year: function () {
            console.log(this.selected_year);
            this.setPeriodForSelectedYear();
        },
        selected_month: function () {
            this.getDataForSelectedPeriod()
        }
    },
    data: function () {
        return {
            properties_mutated: null, 
            expenses_periods: null,
            selected_year: 2021,
            selected_month: null, 
            selected_year_periods: null,
        }
    },
    methods: {
        setPeriodForSelectedYear() {
            this.selected_year_periods = this.expenses_periods[this.selected_year].periods;
        },
        getDataForSelectedPeriod() {
            axios.get('api/expenses', {
                params: {
                    year: this.selected_year,
                    month: this.selected_month,
                }
            })
                .then(function (response) {
                    // handle success
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });            
        }
    }
}
</script>
