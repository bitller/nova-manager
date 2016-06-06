<template>

    <div class="page-container">

        <div class="row">
            <products-header :number-of-products="numberOfProducts" :searched="searched"></products-header>
            <products></products>
        </div>

    </div>

</template>

<script>

import ProductsHeader from '../components/ProductsPage/ProductsHeader.vue';
import Products from '../components/ProductsPage/Products.vue';

export default {

    data: function() {
        return {
            numberOfProducts: 0,
            searched: false,
        }
    },

    components: {
        'products-header': ProductsHeader,
        'products': Products,
    },

    events: {

        'search': function (term) {
            this.$broadcast('search', term);
        },

        'products_updated': function (total, searched) {
            this.numberOfProducts = total;
            this.searched = searched;
        },

        'reload_products': function(title, message) {
            this.$broadcast('reload_products', title, message);
        }
    }

}

</script>
