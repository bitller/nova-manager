<template>

    <div class="page-container">

        <div class="row">
            <bill-header :bill-id="billId" :status="billStatus" :payment-term="paymentTerm" :header-details="headerDetails"></bill-header>
            <products :bill-id="billId" :products="products"></products>
            <informations v-if="!headerDetails.firstBill" :bill-id="billId" :payment-term="headerDetails.paymentTerm" :to-pay="toPay" :saved-money="savedMoney" :other-details="otherDetails"></informations>
        </div>

    </div>

</template>

<script>

import BillHeader from '../components/BillPage/BillHeader.vue';
import Products from '../components/BillPage/Products.vue';
import Informations from '../components/BillPage/Informations.vue';

export default {

    ready: function() {
        this.$dispatch('show_loader');
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
            clientId: '',
            products: {
                available: '',
                notAvailable: ''
            },
            headerDetails: {
                clientName: this.clientName,
                clientId: this.clientId,
                firstBill: false,
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
                vm.paymentTermPassed = success.data.payment_term_passed,
                vm.otherDetails = success.data.other_details;
                vm.campaignNumber = success.data.campaign_number;
                vm.campaignYear = success.data.campaign_year;
                vm.campaignOrder = success.data.campaign_order;
                // vm.clientName = ;
                // vm.clientId = success.data.client_id;

                vm.headerDetails = {
                    clientName: success.data.client_name,
                    clientId: success.data.client_id,
                    paymentTerm: success.data.payment_term,
                    paymentTermPassed: success.data.payment_term_passed,
                    campaignNumber: success.data.campaign_number,
                    campaignYear: success.data.campaign_year,
                    campaignOrder: success.data.campaign_order,
                };

                vm.checkIfIsUserFirstBill();

                if (typeof callback !== 'undefined') {
                    callback();
                } else {
                    vm.$dispatch('close_opened_alert');
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

                vm.headerDetails.paymentTerm = success.data.payment_term;
                vm.headerDetails.paymentTermPassed = success.data.payment_term_passed;
                if (typeof callback !== 'undefined') {
                    callback();
                }

            }, function (error) {
                //
            });

        },

        checkIfIsUserFirstBill: function() {
            console.log(this.getParameterByName('first_bill'));
            if (this.getParameterByName('first_bill') === 'true') {
                this.headerDetails.firstBill = true;
                return;
            }
            this.headerDetails.firstBill = false;
        },

        getParameterByName: function(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

    },

    computed: {
        // headerDetails: function() {
        //     return {
        //
        //     }
        // }
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
                console.log('reloadPaymentTerm() called with callback');
                this.getPaymentTerm(callback);
                return;
            }
            console.log('reloadPaymentTerm() called without callback');
            this.getPaymentTerm();
        }

    },

}

</script>
