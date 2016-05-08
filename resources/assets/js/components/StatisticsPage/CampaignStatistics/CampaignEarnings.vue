<template>

    <div class="panel panel-default">
        <div class="panel-heading">Vânzări</div>
        <div class="panel-body">

            <!-- BEGIN Total earnings -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Valoarea totală a comenzilor</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ totalEarningsInSelectedCampaign }} ron</span></div>
                    </div>
                </div>
            </div>
            <!-- END Total earnings -->

            <!-- BEGIN Total discount -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Valoarea totală a reducerilor</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ totalDiscountInSelectedCampaign }} ron</span></div>
                    </div>
                </div>
            </div>
            <!-- END Total discount -->

            <!-- BEGIN Average order price -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Prețul mediu al unei comenzi</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ averageOrderPriceInSelectedCampaign }} ron</span></div>
                    </div>
                </div>
            </div>
            <!-- END Average order price -->

            <!-- BEGIN Cashed money -->
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Bani deja încasați</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ cashedMoneyInSelectedCampaign }} ron</span></div>
                    </div>
                </div>
            </div>
            <!-- END Cashed money -->

            <!-- BEGIN Not cashed yet money -->
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">Mai trebuie să primiți pentru comenzile din campania 4/2016</div>
                    <div class="panel-body">
                        <div class="row text-center"><span class="statistic">{{ moneyNotCashedYetInSelectedCampaign }} ron</span></div>
                    </div>
                </div>
            </div>
            <!-- END Not cashed yet money -->

        </div>
    </div>

</template>

<script>

export default {

    data: function() {
        return {
            totalEarningsInSelectedCampaign: 0,
            totalDiscountInSelectedCampaign: 0,
            averageOrderPriceInSelectedCampaign: 0,
            cashedMoneyInSelectedCampaign: 0,
            moneyNotCashedYetInSelectedCampaign: 0,
        }
    },

    ready: function() {
        this.getData();
    },

    methods: {
        getData: function() {
            this.totalEarningsInSelectedCampaign = Math.floor(Math.random() * 1000);
            this.totalDiscountInSelectedCampaign = Math.floor(Math.random() * 1000);
            this.averageOrderPriceInSelectedCampaign = Math.floor(Math.random() * 100);
            this.cashedMoneyInSelectedCampaign = Math.floor(Math.random() * 100);
            this.moneyNotCashedYetInSelectedCampaign = Math.floor(Math.random() * 1000);
        }
    }

}

</script>
