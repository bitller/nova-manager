<template>

    <!-- BEGIN Displayed bills -->
    <div class="col-md-3">
        <div class="dropdown">
            <button class="btn btn-default btn-block dropdown-toggle" type="button" data-toggle="dropdown">
                {{ displayedBillsText }}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li @click="changeDisplayedBills('all')"><a href="#">Toate facturile</a></li>
                <li @click="changeDisplayedBills('current_campaign')"><a href="#">Facturile din campania curentă</a></li>
                <li @click="changeDisplayedBills('custom_campaign')"><a href="#">Facturile dintr-o campanie aleasă</a></li>
            </ul>
        </div>
    </div>
    <!-- END Displayed bills -->

    <div v-show="showSelectCustomCampaign">
        <!-- BEGIN Select campaign year -->
        <div class="col-md-3">
            <div class="dropdown">
                <button class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown">
                    Anul 2016 <span class="caret"></span>
                </button>
            </div>
        </div>
        <!-- END Select campaign year -->

        <!-- BEGIN Select campaign number -->
        <div class="col-md-3">
            <div class="dropdown">
                <button class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown">
                    Campania 1 <span class="caret"></span>
                </button>
            </div>
        </div>
        <!-- END Select campaign number -->
    </div>

    <!-- BEGIN Paid and unpaid bills -->
    <div class="col-md-3">
        <div class="dropdown">
            <button class="btn btn-default btn-block dropdown-toggle" type="button" data-toggle="dropdown">
                {{ billsStatusText }}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li @click="changeBillsStatus('all')"><a href="#">Plătite și neplătite</a></li>
                <li @click="changeBillsStatus('paid')"><a href="#">Doar cele plătite</a></li>
                <li @click="changeBillsStatus('unpaid')"><a href="#">Doar cele neplătite</a></li>
            </ul>
        </div>
    </div>
    <!-- END Paid and unpaid bills -->

</template>

<script>

export default {

    ready: function() {
        this.getFilters();
    },

    data: function() {
        return {
            filters: {},
        }
    },

    methods: {

        getFilters: function() {

            var vm = this;
            this.$http.get('/dashboard/bills/get-filters').then(function (success) {
                vm.filters = success.data;
            }, function (error) {
                //
            });

        },

        changeDisplayedBills: function(type) {

            var vm = this;
            var filter = {
                _token: $('#token').attr('content'),
                type: type
            };

            this.$http.post('/dashboard/bills/update-displayed-bills-filter', filter).then(function (success) {
                vm.filters.displayed_bills = type;
            }, function (error) {
                //
            });

        },

        changeBillsStatus: function(status) {

            var vm = this;
            var billsType = {
                _token: $('#token').attr('content'),
                status: status
            }

            this.$http.post('/dashboard/bills/update-bills-status-filter', billsType).then(function (success) {
                vm.filters.bills_status = status;
            }, function (error) {
                //
            });
        },

        selectCampaignYear: function() {
            //
        },

        selectCampaigNumber: function() {
            //
        },

    },

    computed: {

        displayedBillsText: function() {

            if (this.filters.displayed_bills == 'all') {
                return 'Toate facturile';
            }

            if (this.filters.displayed_bills == 'current_campaign') {
                return 'Facturile din campania curenta';
            }

            return 'Facturile dintr-o campanie aleasa';

        },

        billsStatusText: function() {

            if (this.filters.bills_status === 'all') {
                return 'Platite si neplatite';
            }

            if (this.filters.bills_status === 'paid') {
                return 'Doar cele platite';
            }

            return 'Doar cele neplatite';

        },

        showSelectCustomCampaign: function() {

            if (this.filters.displayed_bills === 'custom_campaign') {
                return true;
            }

            return false;
        }

    },

}

</script>
