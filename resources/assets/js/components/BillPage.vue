<template>

    <div class="page-container">

        <div class="row">
            <bill-header></bill-header>
            <products></products>
            <informations></informations>
        </div>

    </div>

</template>

<script>

import BillHeader from '../components/BillPage/BillHeader.vue';
import Products from '../components/BillPage/Products.vue';
import Informations from '../components/BillPage/Informations.vue';

export default {

    components: {
        'bill-header': BillHeader,
        'products': Products,
        'informations': Informations,
    },

}

</script>
