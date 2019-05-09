<template>
    <div v-if="data.latest">
        <div class="card">
            <div class="card-title">
                Account Balance
            </div>
            <div class="card-content">
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

        <div class="card">
            <div class="card-title">
                Investments ({{ data.latest.investments }})
            </div>
            <div class="card-content">
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

        <div class="card">
            <div class="card-title">
                Total Profits
            </div>
            <div class="card-content">
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

        <p>Last update: {{ data.last_update }}</p>
        <button @click="fetchData">Refresh</button>
    </div>
</template>

<script>
    export default {
        name: "Data",
        data: function () {
            return {
                data: {}
            }
        },
        mounted: function () {
            this.fetchData();
        },
        methods: {
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
    .card {
        background: #fff;
        margin-bottom: 15px;
        padding: 10px;
    }

    .card-title {
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 15px;
    }

    .item {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        line-height: 1.5;
    }

    .item .value {
        font-weight: bold;
    }

    dl {
        margin: 0;
    }
</style>