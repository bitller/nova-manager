4<template>

    <div class="col-md-12">

        <!-- BEIGN Bills -->
        <div class="col-md-12 primary">
            <div class="col-md-12">
                <span class="primary-title">{{ buildDisplayedBillsText }}</span>
            </div>
        </div>

        <div class="col-md-12 white last">

            <big-bubbles-loader :loading="loadingBills"></big-bubbles-loader>

            <div v-show="showBills">

                <filters></filters>

                <alert-warning v-if="noBills" message="Nu exista facturi care sa respecte crteriile alese."></alert-warning>

                <div v-if="!noBills" class="col-md-12">
                    <div class="panel panel-default">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Client</th>
                                    <th class="text-center">Produse</th>
                                    <th class="text-center">Preț</th>
                                    <th class="text-center">Comanda</th>
                                    <th class="text-center">Campania</th>
                                    <th class="text-center">Termen de plata</th>
                                    <th class="text-center">Deschide factura</th>
                                    <th class="text-center">Șterge</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="bill in bills.data">
                                    <td class="text-center vert-align"><a href="/dashboard/clients/{{bill.client_id}}">{{ bill.client_name }}</a></td>
                                    <td class="text-center vert-align">{{ displayedNumberOfProducts(bill.quantity) }}</td>
                                    <td class="text-center vert-align">{{ displayPrice(bill.price) }} ron</td>
                                    <td class="text-center vert-align">{{ bill.campaign_order }}</td>
                                    <td class="text-center vert-align">{{ bill.campaign_number }}/{{ bill.campaign_year }}</td>
                                    <td class="text-center vert-align">{{ displayPaymentTerm(bill.payment_term) }}</td>
                                    <td class="text-center vert-align">
                                        <a href="/dashboard/bills/{{bill.id}}"<div class="btn btn-success"><span class="glyphicon glyphicon-eye-open"></span></div>
                                    </td>
                                    <td class="text-center vert-align">
                                        <div @click="deleteBillConfirmation(bill.id)" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div v-if="!noBills" class="col-md-12">
                    <span class="grey">Este afișată pagina {{ bills.current_page }} din {{ bills.last_page }}</span>
                </div>

                <!-- BEGIN Pagination -->
                <div v-show="showPagination">
                    <div class="col-md-6">
                        <div @click="previousPage" :class="{ 'disabled': !bills.prev_page_url }" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Pagina anterioară</div>
                    </div>
                    <div class="col-md-6">
                        <div @click="nextPage" :class="{ 'disabled': !bills.next_page_url }" class="btn btn-primary pull-left">Pagina urmatoare&nbsp;<span class="glyphicon glyphicon-arrow-right"></span></div>
                    </div>
                </div>
                <!-- END Pagination -->

            </div>

            <alert-danger :message="serverError"></alert-danger>

        </div>
    </div>

</template>

<script>

import Filters from '../../components/BillsPage/Bills/Filters.vue';
import AlertDanger from '../../components/Alerts/AlertDanger.vue';
import AlertWarning from '../../components/Alerts/AlertWarning.vue';
import BigBubblesLoader from '../../components/Loaders/BigBubblesLoader.vue';

export default {

    components: {
        'filters': Filters,
        'alert-danger': AlertDanger,
        'alert-warning': AlertWarning,
        'big-bubbles-loader': BigBubblesLoader,
    },

    data: function() {
        return {
            loadingBills: false,
            bills: '',
            serverError: false,
            filters: '',
        }
    },

    ready: function() {
        this.paginateBills();
    },

    methods: {

        previousPage: function() {
            if (!this.bills.prev_page_url) {
                return false;
            }

            this.paginateBills(this.bills.prev_page_url);
        },

        nextPage: function() {
            if (!this.bills.next_page_url) {
                return false;
            }

            this.paginateBills(this.bills.next_page_url);
        },

        paginateBills: function(url, callback) {

            if (this.loadingBills) {
                return false;
            }

            this.loadingBills = true;
            var vm = this;

            if (typeof url === 'undefined') {
                url = '/dashboard/bills/paginate';
            }

            this.$http.get(url).then(function (success) {

                vm.loadingBills = false;
                vm.bills = success.data;
                vm.$dispatch('numberOfBillsUpdated', success.data.total);

                if (typeof callback !== 'undefined') {
                    callback();
                }

            }, function (error) {
                vm.serverError = 'O eroare a avut loc. Redeschide aplicatia pentru a incerca din nou.';
            });

        },

        deleteBillConfirmation: function(billId) {
            var vm = this;

            swal({
                title: 'Sunteți sigur?',
                text: ' Odată ștearsă, o factură nu mai poate fi recuperată.',
                type: "warning",
                showCancelButton: true,
                cancelButtonText: 'Anulează',
                cancelButtonColor: '#bdc3c7',
                confirmButtonColor: "#E05082",
                confirmButtonText: "Șterge factura",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            }, function() {
                vm.deleteBill(billId);
            });
        },

        deleteBill: function(billId) {

            var vm = this;

            var bill = {
                _token: $('#token').attr('content'),
                bill_id: billId
            };

            this.$http.post('/dashboard/bills/delete', bill).then(function (success) {

                var url = '/dashboard/bills/paginate?page=' + vm.bills.current_page;
                vm.paginateBills(url, function() {
                    vm.$dispatch('success_alert', success.data.title, success.data.message);
                });

            }, function (error) {

                vm.$dispatch('error_alert', 'Ooops.', 'O eroare a avut loc.');

            });

        },

        displayPaymentTerm: function(paymentTerm) {
            if (paymentTerm === '0000-00-00') {
                return 'Nu a fost setat';
            }
            return paymentTerm;
        },

        displayedNumberOfProducts: function(numberOfProducts) {
            if (!numberOfProducts) {
                return 0;
            }
            return numberOfProducts;
        },

        displayPrice: function(price) {
            if (!price) {
                return 0;
            }
            return price;
        },

        changeDisplayedBills: function() {
            //
        },
    },

    computed: {

        displayedBillsText: function() {
            return 'Toate facturile';
        },

        showPagination: function() {
            if (!this.bills.next_page_url && !this.bills.prev_page_url) {
                return false;
            }
            return true;
        },

        showBills: function() {
            if (this.serverError || this.loadingBills) {
                return false;
            }
            return true;
        },

        noBills: function() {
            if (this.bills.total < 1) {
                return true;
            }
            return false;
        },

        buildDisplayedBillsText: function() {

            if (this.filters.displayed_bills == 'all') {
                if (this.filters.bills_status === 'all') {
                    return 'Sunt afișate toate facturile plătite și neplătite';
                }

                if (this.filters.bills_status === 'paid') {
                    return 'Sunt afișate toate facturile plătite';
                }

                if (this.filters.bills_status === 'unpaid') {
                    return 'Sunt afișate toate facturile neplătite';
                }
            }

            if (this.filters.displayed_bills === 'current_campaign' || this.filters.displayed_bills === 'custom_campaign') {
                if (this.filters.bills_status === 'all') {
                    return 'Sunt afișate facturile plătite și neplătite din campania ' + this.filters.campaign_number + '/' + this.filters.campaign_year;
                }

                if (this.filters.bills_status === 'paid') {
                    return 'Sunt afișate facturile plătite din campania ' + this.filters.campaign_number + '/' + this.filters.campaign_year;
                }

                if (this.filters.bills_status === 'unpaid') {
                    return 'Sunt afișate facturile neplătite din campania ' + this.filters.campaign_number + '/' + this.filters.campaign_year;
                }
            }
        }


    },

    events: {

        'reloadBills': function() {
            this.paginateBills();
        },

        'filtersUpdated': function(filters) {
            this.filters = filters;
        }
    }

}

</script>
