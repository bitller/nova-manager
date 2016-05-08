<template>

    <div class="row">

        <div class="col-md-4">
            <general-statistics :active="active"></general-statistics>
            <campaign-statistics :active="active"></campaign-statistics>
        </div>

        <div class="col-md-8">

            <!-- BEGIN General statistics group -->
            <general-clients v-if="generalClientsIsTheActiveComponent"></general-clients>
            <general-earnings v-if="generalEarningsIsTheActiveComponent"></general-earnings>
            <general-products v-if="generalProductsIsTheActiveComponent"></general-products>
            <!-- END General statistics group -->

            <!-- BEGIN Campaign statistics group -->
            <select-campaign v-if="activeComponentBelongsToCampaignStatistics"></select-campaign>
            <campaign-clients v-if="campaignClientsIsTheActiveComponent"></campaign-clients>
            <campaign-earnings v-if="campaignEarningsIsTheActiveComponent"></campaign-earnings>
            <campaign-products v-if="campaignProductsIsTheActiveComponent"></campaign-products>
            <!-- END Campaign statistics group -->

        </div>

    </div>

</template>

<script>

import GeneralStatistics from '../components/StatisticsPage/GeneralStatistics.vue';
import CampaignStatistics from '../components/StatisticsPage/CampaignStatistics.vue';

import GeneralClients from '../components/StatisticsPage/GeneralStatistics/GeneralClients.vue';
import GeneralEarnings from '../components/StatisticsPage/GeneralStatistics/GeneralEarnings.vue';
import GeneralProducts from '../components/StatisticsPage/GeneralStatistics/GeneralProducts.vue';

import SelectCampaign from '../components/StatisticsPage/CampaignStatistics/SelectCampaign.vue';
import CampaignClients from '../components/StatisticsPage/CampaignStatistics/CampaignClients.vue';
import CampaignEarnings from '../components/StatisticsPage/CampaignStatistics/CampaignEarnings.vue';
import CampaignProducts from '../components/StatisticsPage/CampaignStatistics/CampaignProducts.vue';

export default {

    props: ['active'],

    data: function() {
        return {
            activeComponent: this.active,
        }
    },

    components: {
        'general-statistics': GeneralStatistics,
        'campaign-statistics': CampaignStatistics,
        'general-clients': GeneralClients,
        'general-earnings': GeneralEarnings,
        'general-products': GeneralProducts,
        'select-campaign': SelectCampaign,
        'campaign-clients': CampaignClients,
        'campaign-earnings': CampaignEarnings,
        'campaign-products': CampaignProducts,
    },

    events: {
        'component_clicked': function() {
            swal({
                title: 'Se incarca...',
                type: 'info',
                showConfirmButton: false
            });
        }
    },

    computed: {

        generalClientsIsTheActiveComponent: function() {
            if (this.activeComponent == 'general_clients') {
                return true;
            }

            return false;
        },

        generalEarningsIsTheActiveComponent: function() {
            if (this.activeComponent == 'general_earnings') {
                return true;
            }

            return false;
        },

        generalProductsIsTheActiveComponent: function() {
            if (this.activeComponent == 'general_products') {
                return true;
            }

            return false;
        },

        campaignClientsIsTheActiveComponent: function() {
            if (this.activeComponent == 'campaign_clients') {
                return true;
            }

            return false;
        },

        campaignEarningsIsTheActiveComponent: function() {
            if (this.activeComponent == 'campaign_earnings') {
                return true;
            }

            return false;
        },

        campaignProductsIsTheActiveComponent: function() {
            if (this.activeComponent == 'campaign_products') {
                return true;
            }

            return false;
        },

        activeComponentBelongsToCampaignStatistics: function() {
            if (this.campaignClientsIsTheActiveComponent || this.campaignEarningsIsTheActiveComponent || this.campaignProductsIsTheActiveComponent) {
                return true;
            }

            return false;
        }
    },

}

</script>
