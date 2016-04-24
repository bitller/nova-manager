manger<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">

        <div class="panel-heading">Statistici</div>

        <div class="list-group">
            <a @click="componentClicked" :class="{ 'active': usersMetricsIsActive }" href="/admin-center/users-metrics/" class="list-group-item">Utilizatori</a>
            <a @click="componentClicked" :class="{ 'active': productsMetricsIsActive }" href="/admin-center/products-metrics/" class="list-group-item">Produse</a>
            <a @click="componentClicked" :class="{ 'active': subscriptionsMetricsIsActive }" href="/admin-center/subscriptions-metrics" class="list-group-item">Abonamente</a>
        </div>

    </div>
    <!-- END Panel -->

</template>

<script>

export default {

    props: ['active'],

    methods: {

        componentClicked: function() {
            this.$dispatch('component_clicked');
        }

    },

    computed: {

        usersMetricsIsActive: function() {
            if (this.active == 'users_metrics') {
                return true;
            }

            return false;
        },

        productsMetricsIsActive: function() {
            if (this.active == 'products_metrics') {
                return true;
            }

            return false;
        },

        subscriptionsMetricsIsActive: function() {
            if (this.active == 'subscriptions_metrics') {
                return true;
            }

            return false;
        }

    }

}
</script>
