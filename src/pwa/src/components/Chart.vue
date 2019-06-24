<script>
    import { Line } from 'vue-chartjs';

    export default {
        name: "Chart",
        extends: Line,
        props: {
            chartdata: {
                type: Object,
                default: null
            },
            options: {
                type: Object,
                default: null
            }
        },
        mounted () {
            this.renderChart(this.chartdata, this.options);

        },
    }
</script>

<style scoped>

</style>