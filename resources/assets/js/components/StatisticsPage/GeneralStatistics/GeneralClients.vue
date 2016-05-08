<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">Statistici clienți</div>
        <div class="panel-body">
            <!-- BEGIN Number of clients -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Numărul total al clienților</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ numberOfClients }}</span></div>
                    </div>
                </div>
            </div>
            <!-- END Number of clients -->

            <!-- BEGIN Eranings per client -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Vânzări per client</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ earningsPerClient }} ron</span></div>
                    </div>
                </div>
            </div>
            <!-- END Earnings per client -->

        </div>
    </div>
    <!-- END Panel -->

</template>

<script>

export default {

    data: function() {
        return {
            numberOfClients: 0,
            earningsPerClient: 0,
        }
    },

    ready: function() {
        this.numberOfClients = 144;
        this.earningsPerClient = 144.39;
    }

}

</script>
