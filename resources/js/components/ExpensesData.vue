<template>
    <div>
        <div class="card-header">Expenses tracker</div>

        <div class="card-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Months</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01">
                    <option selected>Choose...</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        expenses_periods: null,
    },
    data: function () {
        return {
            // expenses_periods: this.expenses_periods,
        }
    },
    mounted() {
        this.expenses_periods = JSON.parse(this.expenses_periods);
        console.log('Component mounted.')
    }
}
</script>
