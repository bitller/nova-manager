<template>

    <div class="col-md-12">

        <div class="col-md-12 primary">
            <div class="col-md-12"><span class="primary-title">Statistici</span></div>
        </div>

        <div class="col-md-12 white">
            <div class="col-md-4">
                <earnings earnings="44.44"></earnings>
            </div>

            <div class="col-md-4">
                <ordered-products products="10"></ordered-products>
            </div>

            <div class="col-md-4">
                <orders orders="4"></orders>
            </div>

        </div>

    </div>

</template>

<script>

import Earnings from '../../components/ClientPage/Statistics/Earnings.vue';
import OrderedProducts from '../../components/ClientPage/Statistics/OrderedProducts.vue';
import Orders from '../../components/ClientPage/Statistics/Orders.vue';

export default {

    components: {
        'earnings': Earnings,
        'ordered-products': OrderedProducts,
        'orders': Orders,
    }

}

</script>
