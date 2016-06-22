<template>

    <div class="page-container">

        <div class="row">
            <bill-header :bill-id="billId" :status="billStatus" :payment-term="paymentTerm"></bill-header>
            <products :bill-id="billId" :products="products"></products>
            <informations :payment-term="paymentTerm" :to-pay="toPay" :saved-money="savedMoney"></informations>
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
            billStatus: '',
            toPay: '',
            savedMoney: '',
            paymentTerm: '',
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
        getData: function(callback) {

            this.loading = true;
            var vm = this;
            this.$http.get('/dashboard/bills/' + this.billId + '/get').then(function (success) {

                vm.loading = false;
                vm.products.available = success.data.products;
                vm.products.notAvailable = success.data.not_available_products;
                vm.billStatus = success.data.status;
                vm.toPay = success.data.to_pay;
                vm.savedMoney = success.data.saved_money;
                vm.paymentTerm = success.data.payment_term;

                if (typeof callback !== 'undefined') {
                    callback();
                }

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

        },

        getPaymentTerm: function(callback) {

            var vm = this;
            this.$http.get('/dashboard/bills/' + this.billId + '/get-payment-term').then(function (success) {

                vm.paymentTerm = success.data.payment_term;
                if (typeof callback !== 'undefined') {
                    callback();
                }

            }, function (error) {
                //
            });

        },

    },

    events: {

        'reloadProducts': function(callback) {
            if (typeof callback !== 'undefined') {
                this.getData(callback);
                return;
            }
            this.getData();
        },

        'reloadPaymentTerm': function(callback) {
            if (typeof callback !== 'undefined') {
                this.getPaymentTerm(callback);
                return;
            }
            this.getPaymentTerm();
        }
        
    },

}

</script>
