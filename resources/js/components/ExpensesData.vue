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
            
            <div class="mb-3">
                <div class="d-flex justify-content-center" v-if="loading">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
               
                <table class="table table-striped" v-if="expenses && !loading">
                    <thead>
                    <tr>
                        <th scope="col">title</th>
                        <th scope="col">amount</th>
                        <th scope="col">category</th>
                        <th scope="col">data</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr  v-for="expense in  expenses">
                        <td>{{ expense.title }}</td>
                        <td>{{ expense.amount }}</td>
                        <td>{{ expense.category.title }}</td>
                        <td>{{ moment(expense.created_at).format('YYYY-MM-DD hh:mm:ss a') }}</td>
                    </tr>                    
                    </tbody>
                </table>
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
        this.selected_month = (new Date()).getMonth() + 1; // set current month as selected
    },

    watch: {
        selected_year: function () {
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
            expenses: null,
            loading: false,
        }
    },
    methods: {
        setPeriodForSelectedYear() {
            this.selected_year_periods = this.expenses_periods[this.selected_year].periods;
        },
        getDataForSelectedPeriod() {
            this.loading = true;
            
            axios.get('api/expenses', {
                params: {
                    year: this.selected_year,
                    month: this.selected_month,
                }
            })
                .then(function (response) {
                    this.expenses = response.data.expenses;
                }.bind(this))
                .catch(function (error) {
                    console.error(error);
                })
                .then(function () {
                    this.loading = false;
                }.bind(this));            
        }
    }
}
</script>
