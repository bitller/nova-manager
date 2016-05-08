<template>

    <div class="panel panel-default">
        <div class="panel-heading">Statistici generale</div>
        <div class="list-group">
            <a @click="componentClicked" :class="{ 'active': clientsIsActive }" href="/dashboard/statistics/general/clients" class="list-group-item">Clienți</a>
            <a @click="componentClicked" :class="{ 'active': earningsIsActive }" href="/dashboard/statistics/general/earnings" class="list-group-item">Vânzări</a>
            <a @click="componentClicked" :class="{ 'active': productsIsActive }" href="/dashboard/statistics/general/products" class="list-group-item">Produse</a>
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

        clientsIsActive: function() {
            if (this.active === 'general_clients') {
                return true;
            }

            return false;
        },

        earningsIsActive: function() {
            if (this.active === 'general_earnings') {
                return true;
            }

            return false;
        },

        productsIsActive: function() {
            if (this.active === 'general_products') {
                return true;
            }

            return false;
        },

    }

}

</script>
