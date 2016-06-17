<template>

    <div class="page-container">

        <div class="row">
            <bill-header></bill-header>
            <products :bill-id="billId" :products="products"></products>
            <informations></informations>
        </div>

    </div>

</template>

<script>

import BillHeader from '../components/BillPage/BillHeader.vue';
import Products from '../components/BillPage/Products.vue';
import Informations from '../components/BillPage/Informations.vue';

export default {

    ready: function() {
        this.getData();
    },

    props: ['billId'],

    data: function() {
        return {
            products: {
                available: '',
                notAvailable: ''
            },
        }
    },

    components: {
        'bill-header': BillHeader,
        'products': Products,
        'informations': Informations,
    },

    methods: {
        getData: function() {

            this.loading = true;
            var vm = this;

            this.$http.get('/dashboard/bills/' + this.billId + '/get').then(function (success) {
                vm.loading = false;
                vm.products.available = success.data.products;
                vm.products.notAvailable = success.data.not_available_products;
            }, function (error) {
                //
            });

        },

        getOnlyProducts: function(callback) {

            var vm = this;

            this.$http.get('/dashboard/bills/' + this.billId + '/get-only-products').then(function (success) {

                vm.products.available = success.data.products;
                vm.products.notAvailable = success.data.not_available_products;

                if (typeof callback !== 'undefined') {
                    callback();
                }

            }, function (error) {
                //
            });

        }
    },

    events: {

        'reloadProducts': function(callback) {
            if (typeof callback !== 'undefined') {
                this.getOnlyProducts(callback);
                return;
            }
            this.getOnlyProducts();
        },

    }

}

</script>
