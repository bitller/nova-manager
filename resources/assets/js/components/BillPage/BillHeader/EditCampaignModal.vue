<template>

    <!-- BEGIN Modal -->
    <div id="edit-campaign-modal" data-backdrop="static" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <!-- BEGIN Modal header -->
                <div class="modal-header">
                    <button @click="closeModal" type="button" class="close">&times;</button>
                    <h4 class="modal-title">{{ modal.title }}</h4>
                </div>
                <!-- END Modal header -->

                <!-- BEGIN Modal body -->
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="col-md-12">
                                <div class="alert alert-info">Folosind formularul de mai jos, puteți alege altă campanie pentru această factură.</div>
                                <div v-show="hasError" class="alert alert-danger">{{ hasError }}</div>
                            </div>

                            <!-- BEGIN Campaign year -->
                            <div class="col-md-3">
                                <div class="dropdown">
                                    <label>Anul campaniei</label>
                                    <button class="btn btn-default btn-block dropdown-toggle" type="button" data-toggle="dropdown">
                                        {{ selectedCampaignYear }}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li v-for="(index, campaign) in campaigns" @click="selectCampaignYear(campaign)"><a href="#">{{ index }}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- END Campaign year -->

                            <!-- BEGIN Campaign number -->
                            <div class="col-md-4">
                                <div class="dropdown">
                                    <label>Numarul campaniei</label>
                                    <button class="btn btn-default btn-block dropdown-toggle" type="button" data-toggle="dropdown">
                                        {{ selectedCampaignNumber }}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li v-for="(index, campaign) in campaigns[selectedCampaignYear]" @click="selectCampaignNumber(campaign)"><a href="#">{{ campaign.number }}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- END Campaign number -->

                        </div>
                    </div>
                </div>
                <!-- END Modal body -->

                <!-- BEGIN Modal footer -->
                <div class="modal-footer">
                    <button @click="closeModal" :class="{ 'disabled': loading }" type="button" class="btn btn-default">Anulează</button>
                    <button @click="updateCampaign" :class="{ 'disabled': loading }" type="button" class="btn btn-primary">
                        <span v-show="!loading">Salvează</span>
                        <img v-show="loading" src="/img/loading-bubbles.svg" />
                    </button>
                </div>
                <!-- END Modal footer -->

            </div>
            <!-- END Modal content -->

        </div>
    </div>
    <!-- END Modal -->

</template>

<script>

export default {

    props: ['campaignNumber', 'campaignYear', 'campaignOrder', 'billId'],

    data: function() {
        return {
            loading: false,
            campaigns: '',
            selectedCampaignYear: '',
            selectedCampaignNumber: '',
            error: '',
            modal: {
                title: 'Campania si numarul comenzii',
                selector: '#edit-campaign-modal',
            },
        }
    },

    methods: {

        showModal: function() {
            $(this.modal.selector).modal('show');
            this.getCampaigns();
        },

        closeModal: function() {
            $(this.modal.selector).modal('hide');
        },

        getCampaigns: function() {

            this.loading = true;
            var vm = this;

            this.$http.get('/dashboard/bills/' + this.billId + '/get-campaigns').then(function (success) {
                vm.campaigns = success.data.campaigns;
                vm.loading = false;
            }, function (error) {
                //
            });
        },

        updateCampaign: function() {

            this.loading = true;
            var vm = this;
            var data = {
                _token: $('#token').attr('content'),
                campaign_number: this.selectedCampaignNumber,
                campaign_year: this.selectedCampaignYear
            };

            this.$http.post('/dashboard/bills/' + this.billId + '/update-campaign', data).then(function (success) {

                vm.$dispatch('reloadCampaign', function() {
                    vm.loading = false;
                    vm.$dispatch('success_alert', success.data.title, success.data.message);
                    vm.closeModal();
                });

            }, function (error) {
                vm.loading = false;
                vm.checkForErrors(error.data);
            });

        },

        checkForErrors: function(data) {
            if (typeof data.errors === 'undefined') {
                this.error = 'O eroare a avut loc.';
                return;
            }

            var errors = data.errors;
            if (errors.campaign_number) {
                this.error = errors.campaig_number;
                return;
            }
            if (errors.campaign_year) {
                this.error = errors.campaign_year;
            }
        },

        selectCampaignYear: function(campaign) {
            this.selectedCampaignYear = campaign.year;
        },

        selectCampaignNumber: function(campaign) {
            this.selectedCampaignNumber = campaign.number;
        },

    },

    computed: {
        hasError: function() {
            if (!this.loading && this.error) {
                return this.error;
            }
            return;
        }
    },

    events: {
        'showEditCampaignModal': function() {
            this.showModal();
        }
    },

    watch: {
        'campaignYear': function(value) {
            this.selectedCampaignYear = value;
            this.selectedCampaignNumber = this.campaignNumber;
        }
    }
}

</script>
