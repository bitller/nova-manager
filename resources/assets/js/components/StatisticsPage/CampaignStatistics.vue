<template>

    <div class="panel panel-default">
        <div class="panel-heading">Statistici per campanie</div>
        <div class="list-group">
            <a @click="componentClicked" :class="{ 'active': campaignClientsIsActive }" href="/dashboard/statistics/campaign/clients" class="list-group-item">Clienți</a>
            <a @click="componentClicked" :class="{ 'active': campaignEarningsIsActive }" href="/dashboard/statistics/campaign/earnings" class="list-group-item">Vânzări</a>
            <a @click="componentClicked" :class="{ 'active': campaignProductsIsActive }" href="/dashboard/statistics/campaign/products" class="list-group-item">Produse</a>
        </div>
    </div>

</template>

<script>

export default {

    props: ['active'],

    methods: {

        componentClicked: function() {
            this.$dispatch('component_clicked');
        },

    },

    computed: {

        campaignClientsIsActive: function() {
            if (this.active === 'campaign_clients') {
                return true;
            }

            return false;
        },

        campaignEarningsIsActive: function() {
            if (this.active === 'campaign_earnings') {
                return true;
            }

            return false;
        },

        campaignProductsIsActive: function() {
            if (this.active === 'campaign_products') {
                return true;
            }

            return false;
        },

    }

}

</script>
