hp<style>
.bottom-space {
    margin-bottom: 18px;
}
</style>

<template>

    <div>
        <!-- BEGIN Displayed bills -->
        <div class="col-md-3 bottom-space">
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
                        {{ campaignYearText }} <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li v-for="campaign in filters.campaign_years" @click="selectCampaignYear(campaign.year)"><a href="#">{{ campaign.year }}</a></li>
                    </ul>
                </div>
            </div>
            <!-- END Select campaign year -->

            <!-- BEGIN Select campaign number -->
            <div class="col-md-3">
                <div class="dropdown">
                    <button class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown">
                        {{ campaignNumberText }} <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li v-for="campaign in filters.campaign_numbers" @click="selectCampaignNumber(campaign.number)"><a href="#">Campania {{ campaign.number }}</a></li>
                    </ul>
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
    </div>

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
                vm.$dispatch('filtersUpdated', success.data);
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
                vm.$dispatch('reloadBills');
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
                vm.$dispatch('reloadBills');
            }, function (error) {
                //
            });
        },

        selectCampaignYear: function() {
            //
        },

        /**
         * Allow user to select another campaign number filter.
         *
         * @param campaignNumber
         */
        selectCampaignNumber: function(campaignNumber) {

            var vm = this;
            var data = {
                _token: $('#token').attr('content'),
                campaign_number: campaignNumber
            };

            this.$http.post('/dashboard/bills/update-campaign-number', data).then(function (success) {
                vm.filters.campaign_number = campaignNumber;
                vm.$dispatch('reloadBills');
            }, function (error) {
                //
            });

        },

        /**
         * Allow user to select another campaign year filter.
         *
         * @param campaignYear
         */
        selectCampaignYear: function(campaignYear) {

            var vm = this;
            var data = {
                _token: $('#token').attr('content'),
                campaign_year: campaignYear
            };

            this.$http.post('/dashboard/bills/update-campaign-year', data).then(function (success) {
                vm.filters.campaign_year = campaignYear;
                vm.$dispatch('reloadBills');
            }, function (error) {
                //
            });

        }

    },

    computed: {

        /**
         * Return text displayd on displayed bills button (first button).
         */
        displayedBillsText: function() {

            if (this.filters.displayed_bills == 'all') {
                return 'Toate facturile';
            }

            if (this.filters.displayed_bills == 'current_campaign') {
                return 'Facturile din campania curenta';
            }

            return 'Facturile dintr-o campanie aleasa';

        },

        /**
         * Return text displayed on bills status button (last button when all are displayed).
         */
        billsStatusText: function() {

            if (this.filters.bills_status === 'all') {
                return 'Platite si neplatite';
            }

            if (this.filters.bills_status === 'paid') {
                return 'Doar cele platite';
            }

            return 'Doar cele neplatite';

        },

        /**
         * Return text displayed on campaign year button (second one when all four buttons are displayed).
         */
        campaignYearText: function() {
            return 'Anul ' + this.filters.campaign_year;
        },

        /**
         * Return text displayed on campaign number button (third one when all fourd are diplayed).
         */
        campaignNumberText: function() {
            return 'Campania ' + this.filters.campaign_number;
        },

        /**
         * Check if campaign year and campaign number buttons should be displayed.
         */
        showSelectCustomCampaign: function() {

            if (this.filters.displayed_bills === 'custom_campaign') {
                return true;
            }

            return false;
        }

    },

}

</script>
