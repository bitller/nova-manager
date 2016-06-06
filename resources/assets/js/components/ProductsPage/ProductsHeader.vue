<template>

    <div class="col-md-12">
        <div class="col-md-12 white first">

            <!-- BEGIN Products text -->
            <div class="col-md-8">
                <span class="page-title grey-dark">Produse</span>
                <span class="page-description grey">
                    <span v-show="!searched && numberOfProducts != 1" class="page-description grey">Aveţi {{ numberOfProducts }} {{ bound }} produse</span>
                    <span v-show="!searched && numberOfProducts == 1" class="page-description grey">Aveţi {{ numberOfProducts }} produs</span>
                    <span v-show="searched && numberOfProducts != 1" class="page-description grey">{{ numberOfProducts }} {{ bound }} produse găsite</span>
                    <span v-show="searched && numberOfProducts == 1" class="page-description grey">{{ numberOfProducts }} produs găsit</span>
                </span>
            </div>
            <!-- END Products text -->

            <add-product></add-product>

        </div>
    </div>

</template>

<script>

import AddProduct from '../../components/ProductsPage/ProductsHeader/AddProduct.vue';

export default {

    props: ['numberOfProducts', 'searched'],

    data: function() {
        return {
            bound: '',
        }
    },

    components: {
        'add-product': AddProduct,
    },

    computed: {

        bound: function() {
            if (this.numberOfProducts < 19) {
                return '';
            }

            var lastTwo = this.numberOfProducts % 100;
            if (lastTwo > 19) {
                return 'de';
            }
        },

    },

}

</script>
