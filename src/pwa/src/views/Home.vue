<template>
    <div v-if="data.latest">
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Account Balance
                                </p>
                            </header>
                            <div class="card-content">
                                <div class="content">
                                    <div class="item">
                                        <span class="label">
                                            Available
                                        </span>
                                        <span class="value">
                                            {{ data.latest.available_funds | currency('€') }}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <span class="label">
                                            Invested
                                        </span>
                                        <span class="value">
                                            {{ data.latest.investments_total | currency('€') }}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <span class="label">
                                            Total
                                        </span>
                                        <span class="value">
                                            {{ data.latest.balance | currency('€') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Investments ({{ data.latest.investments }})
                                </p>
                            </header>
                            <div class="card-content">
                                <div class="content">
                                    <div class="item">
                                        <span class="label">
                                            Current
                                        </span>
                                        <span class="value">
                                            {{ data.latest.investments_current | currency('€')}}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <span class="label">
                                            Grace period
                                        </span>
                                        <span class="value">
                                            {{ data.latest.investments_grace_period | currency('€')}}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <span class="label">
                                            1-15 days late
                                        </span>
                                        <span class="value">
                                            {{ data.latest.investments_1_15_late | currency('€')}}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <span class="label">
                                            16-30 days late
                                        </span>
                                        <span class="value">
                                            {{ data.latest.investments_16_30_late | currency('€')}}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <span class="label">
                                            31-60 days late
                                        </span>
                                        <span class="value">
                                            {{ data.latest.investments_31_60_late | currency('€')}}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <span class="label">
                                            60+ days late
                                        </span>
                                        <span class="value">
                                            {{ data.latest.investments_61_late | currency('€')}}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <span class="label">
                                            Default
                                        </span>
                                        <span class="value">
                                            {{ data.latest.investments_default | currency('€')}}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <span class="label">
                                            Bad debt
                                        </span>
                                        <span class="value">
                                            {{ data.latest.investments_bad_debt | currency('€')}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Total Profits
                                </p>
                            </header>
                            <div class="card-content">
                                <div class="content">
                                    <div class="item">
                                        <span class="label">
                                            Last Day
                                        </span>
                                        <span class="value">
                                            {{ data.total_profits.last_day | currency('€') }}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <span class="label">
                                            Last Week
                                        </span>
                                        <span class="value">
                                            {{ data.total_profits.last_week | currency('€') }}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <span class="label">
                                            Last Month
                                        </span>
                                        <span class="value">
                                            {{ data.total_profits.last_month | currency('€') }}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <span class="label">
                                            Last Year
                                        </span>
                                        <span class="value">
                                            {{ data.total_profits.last_year | currency('€') }}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <span class="label">
                                            All Time
                                        </span>
                                        <span class="value">
                                            {{ data.latest.total_profit | currency('€') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <Chart :chartdata="data.daily_profits" ></Chart>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <p>Last update: {{ data.last_update }}</p>
                        <button @click="fetchData" class="button is-primary">Refresh</button>
                    </div>
                </div>
            </div>
        </section>





    </div>
</template>

<script>
    import Chart from "../components/Chart";

    export default {
        name: "Data",
        components: { Chart },
        data: function () {
            return {
                data: {},
            }
        },
        mounted: function () {
            this.fetchData();
        },
        methods: {
            /**
             * fetch data from api
             */
            fetchData() {
                this.axios
                    .get(`/api/data`)
                    .then((response) => {
                        this.data = response.data;
                    })
            }
        }
    }
</script>

<style scoped>
    .item {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        line-height: 1.5;
    }

    .item .value {
        font-weight: bold;
    }
</style>