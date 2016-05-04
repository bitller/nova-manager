<template>

    <div class="page-container">

        <div class="row">
            <products-header></products-header>
            <products></products>
        </div>

    </div>

</template>

<script>

import ProductsHeader from '../components/ProductsPage/ProductsHeader.vue';
import Products from '../components/ProductsPage/Products.vue';

export default {

    components: {
        'products-header': ProductsHeader,
        'products': Products,
    }

}

</script>
