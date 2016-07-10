<template>

    <div class="page-container">

        <div class="row">
            <bill-header :bill-id="billId" :status="billStatus" :payment-term="paymentTerm" :header-details="headerDetails"></bill-header>
            <products :bill-id="billId" :products="products"></products>
            <informations :payment-term="paymentTerm" :to-pay="toPay" :saved-money="savedMoney" :other-details="otherDetails"></informations>
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
            otherDetails: '',
            campaignNumber: '',
            campaignYear: '',
            campaignOrder: '',
            clientName: '',
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
                vm.otherDetails = success.data.other_details;
                vm.campaignNumber = success.data.campaign_number;
                vm.campaignYear = success.data.campaign_year;
                vm.campaignOrder = success.data.campaign_order;
                vm.clientName = success.data.client_name;

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

        getCampaign: function(callback) {
            var vm = this;
            this.$http.get('/dashboard/bills/' + this.billId + '/get-campaign').then(function (success) {
                vm.campaignYear = success.data.campaign_year;
                vm.campaignNumber = success.data.campaign_number;
                if (typeof callback !== 'undefined') {
                    callback();
                }
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

    computed: {
        headerDetails: function() {
            return {
                clientName: this.clientName,
                campaignNumber: this.campaignNumber,
                campaignYear: this.campaignYear,
                campaignOrder: this.campaignOrder
            }
        }
    },

    events: {

        'reloadProducts': function(callback) {
            if (typeof callback !== 'undefined') {
                this.getData(callback);
                return;
            }
            this.getData();
        },

        'reloadCampaign': function(callback) {
            if (typeof callback !== 'undefined') {
                this.getCampaign(callback);
                return;
            }
            this.getCampaign();
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
