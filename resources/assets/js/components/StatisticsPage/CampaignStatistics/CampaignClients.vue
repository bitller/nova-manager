<template>

    <div class="panel panel-default">
        <div class="panel-heading">Clienți</div>
        <div class="panel-body">

            <!-- BEGIN Clients who ordered in selected campaign -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Care au comandat în această campanie</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ clientsWhoOrderedInSelectedCampaign }}</span></div>
                    </div>
                </div>
            </div>
            <!-- END Clients who ordered is selected campaign -->

            <!-- BEGIN Percent of clients who ordered in selected campaign -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Care nu au comandat în această campanie</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ clientsWhoNotOrderedInSelectedCampaign }}</span></div>
                    </div>
                </div>
            </div>
            <!-- END Percent of clients who ordered in selected campaign -->

            <!-- BEGIN Averate products per client -->
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">Fiecare client a cumpărat în medie</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ averageProductsPerClient }} produse</span></div>
                    </div>
                </div>
            </div>
            <!-- END Average products per client -->

            <!-- <div class="col-md-12"> -->
                <!-- <canvas id="clients-chart" width="400" height="100"></canvas> -->
            <!-- </div> -->

        </div>
    </div>

</template>

<script>

export default {

    data: function() {
        return {
            clientsWhoOrderedInSelectedCampaign: 0,
            clientsWhoNotOrderedInSelectedCampaign: 0,
            averageProductsPerClient: 0,
        }
    },

    ready: function() {
        // this.initializeChart();
        this.getData();
    },

    methods: {

        getData: function() {
            this.clientsWhoOrderedInSelectedCampaign = 10;
            this.clientsWhoNotOrderedInSelectedCampaign = 44;
            this.averageProductsPerClient = 14;
        },

        initializeChart: function() {

            var ctx = $('#clients-chart');

            var data = {
                labels: [
                    'Clienți care au comandat în această campanie',
                    'Clienți care nu au comandat în această campanie'
                ],

                datasets: [
                    {
                        data: [148, 244],
                        backgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                        ],
                        hoverBackgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                        ]
                    }
                ]
            };

            var clientsChart = new Chart(ctx, {
                type: 'pie',
                data: data,
            });
        },

    }

}

</script>
