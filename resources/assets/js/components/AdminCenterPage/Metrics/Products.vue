<template>

    <base-products :base-products="baseProducts"></base-products>
    <total-products :total-products="totalProducts"></total-products>

</template>

<script>

import BaseProducts from '../../../components/AdminCenterPage/Metrics/Products/BaseProducts.vue';
import TotalProducts from '../../../components/AdminCenterPage/Metrics/Products/TotalProducts.vue';

export default {

    components: {
        'base-products': BaseProducts,
        'total-products': TotalProducts,
    },

    ready: function() {
        this.getMetrics();
    },

    data: function() {
        return {
            baseProducts: 0,
            totalProducts: 0,
        }
    },

    methods: {

        getMetrics: function() {
            this.baseProducts = 1404;
            this.totalProducts = 133212;
        }

    }

}

</script>
