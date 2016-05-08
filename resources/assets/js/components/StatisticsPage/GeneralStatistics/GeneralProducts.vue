<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">
        <div class="panel-heading">Statistici produse</div>
        <div class="panel-body">

            <!-- BEGIN Sold products -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Produse vândute</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ soldProducts }}</span></div>
                    </div>
                </div>
            </div>
            <!-- END Sold products -->

            <!-- BEGIN Average products per bill -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Media produselor dintr-o factură</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ averageProductsPerBill }}</span></div>
                    </div>
                </div>
            </div>
            <!-- END Average products per bill -->

            <!-- BEGIN Average products per client -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Media produselor cumpărate de un client</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ averageProductsPerClient }}</span></div>
                    </div>
                </div>
            </div>
            <!-- END Average products per client -->

            <!-- BEGIN Average price per product -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Prețul mediu al unui produs</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ averageProductPrice }} ron</span></div>
                    </div>
                </div>
            </div>
            <!-- END Average price per product -->

        </div>
    </div>

</template>

<script>

export default {

    data: function() {
        return {
            soldProducts: 0,
            averageProductsPerBill: 0,
            averageProductsPerClient: 0,
            averageProductPrice: 0,
        }
    },

    ready: function() {
        this.soldProducts = 2634;
        this.averageProductsPerBill = 29;
        this.averageProductsPerClient = 22;
        this.averageProductPrice = 33.34;
    },

}

</script>
