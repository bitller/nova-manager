<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">Statistici vânzări</div>
        <div class="panel-body">

            <!-- BEGIN Total earnings -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Vânzări totale
                    </div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ totalEranings }} ron</span></div>
                    </div>
                </div>
            </div>
            <!-- END Total earnings -->

            <!-- BEGIN Average bill price -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                         Prețul mediu al unei facturi
                    </div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ averageBillPrice }} ron</span></div>
                    </div>
                </div>
            </div>
            <!-- END Average bill price -->

        </div>
    </div>
    <!-- END Panel -->

</template>

<script>

export default {

    data: function() {
        return {
            totalEarnings: 0,
            averageBillPrice: 0,
        }
    },

    ready: function() {
        this.totalEarnings = 1311.24;
        this.averageBillPrice = 144.12
    },

}

</script>
