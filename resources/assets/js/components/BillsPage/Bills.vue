<template>

    <div class="col-md-12">

        <!-- BEIGN Bills -->
        <div class="col-md-12 primary">
            <div class="col-md-12">
                <span class="primary-title">Sunt afișate toate facturile plătite și neplătite</span>
            </div>
        </div>

        <div class="col-md-12 white last">

            <filters></filters>

            <div class="col-md-12">
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
                                <td class="text-center vert-align"><a href="#">{{ bill.client_name }}</a></td>
                                <td class="text-center vert-align"></td>
                                <td class="text-center vert-align">ron</td>
                                <td class="text-center vert-align">{{ bill.campaign_order }}</td>
                                <td class="text-center vert-align">{{ bill.campaign_number }}/{{ bill.campaign_year }}</td>
                                <td class="text-center vert-align">{{ bill.payment_term }}</td>
                                <td class="text-center vert-align">
                                    <div class="btn btn-success"><span class="glyphicon glyphicon-eye-open"></span></div>
                                </td>
                                <td class="text-center vert-align">
                                    <div class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-12">
                <span class="grey">Este afișată pagina {{ bills.current_page }} din {{ bills.last_page }}</span>
            </div>

            <!-- BEGIN Pagination -->
            <div class="col-md-6">
                <div @click="previousPage" :class="{ 'disabled': !bills.prev_page_url }" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Pagina anterioară</div>
            </div>
            <div class="col-md-6">
                <div @click="nextPage" :class="{ 'disabled': !bills.next_page_url }" class="btn btn-primary pull-left">Pagina urmatoare&nbsp;<span class="glyphicon glyphicon-arrow-right"></span>
            </div>
            <!-- END Pagination -->

        </div>
        <!-- END Bills -->

    </div>

</template>

<script>

import Filters from '../../components/BillsPage/Bills/Filters.vue';

export default {

    components: {
        'filters': Filters,
    },

    data: function() {
        return {
            loadingBills: false,
            bills: '',
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

                if (typeof callback !== 'undefined') {
                    callback();
                }

            }, function (error) {
                //
            });

        },

        changeDisplayedBills: function() {
            //
        }

    },

    computed: {

        displayedBillsText: function() {
            return 'Toate facturile';
        }

    }

}

</script>
