<template>

    <!-- BEGIN Row -->
    <div class="row">

        <!-- BEGIN Left column -->
        <div class="col-md-4">

            <admin-center :active="active"></admin-center>
            <help-center :active="active"></help-center>
            <metrics :active="active"></metrics>

        </div>
        <!-- END Left column -->

        <!-- BEGIN Right column -->
        <div class="col-md-8">

            <!-- BEGIN Admin center group -->
            <users v-if="usersIsTheActiveComponent" :sub-section="subSection" :user-id="userId"></users>
            <announcements v-if="announcementsIsTheActiveComponent"></announcements>
            <application-settings v-if="applicationSettingsIsTheActiveComponent"></application-settings>
            <!-- END Admin center group -->

            <!-- BEGIN Help center group -->
            <frequent-questions v-if="frequentQuestionsIsTheActiveComponent"></frequent-questions>
            <tickets v-if="ticketsIsTheActiveComponent"></tickets>
            <!-- END Help center group -->

            <!-- BEGIN Metrics group -->
            <users-metrics v-if="usersMetricsIsTheActiveComponent"></users-metrics>
            <products-metrics v-if="productsMetricsIsTheActiveComponent"></products-metrics>
            <subscriptions-metrics v-if="subscriptionsMetricsIsTheActiveComponent"></subscriptions-metrics>
            <!-- END Metrics group -->

        </div>
        <!-- END Right column -->

    </diV>
    <!-- END Row -->

</template>

<script>

import AdminCenter from '../components/AdminCenterPage/AdminCenter.vue';
import HelpCenter from '../components/AdminCenterPage/HelpCenter.vue';
import Metrics from '../components/AdminCenterPage/Metrics.vue';

import Users from '../components/AdminCenterPage/AdminCenter/Users.vue';
import Announcements from '../components/AdminCenterPage/AdminCenter/Announcements.vue';
import ApplicationSettings from '../components/AdminCenterPage/AdminCenter/ApplicationSettings.vue';

import FrequentQuestions from '../components/AdminCenterPage/HelpCenter/FrequentQuestions.vue';
import Tickets from '../components/AdminCenterPage/HelpCenter/Tickets.vue';

import UsersMetrics from '../components/AdminCenterPage/Metrics/Users.vue';
import ProductsMetrics from '../components/AdminCenterPage/Metrics/Products.vue';
import SubscriptionsMetrics from '../components/AdminCenterPage/Metrics/Subscriptions.vue';

export default {

    props: ['active', 'subSection', 'userId'],

    data: function() {
        return {
            activeComponent: this.active
        }
    },

    components: {
        'admin-center': AdminCenter,
        'help-center': HelpCenter,
        'metrics': Metrics,
        'users': Users,
        'announcements': Announcements,
        'application-settings': ApplicationSettings,
        'tickets': Tickets,
        'frequent-questions': FrequentQuestions,
        'users-metrics': UsersMetrics,
        'products-metrics': ProductsMetrics,
        'subscriptions-metrics': SubscriptionsMetrics,
    },

    computed: {

        usersIsTheActiveComponent: function() {
            if (this.activeComponent == 'users') {
                return true;
            }

            return false;
        },

        announcementsIsTheActiveComponent: function() {
            if (this.activeComponent == 'announcements') {
                return true;
            }

            return false;
        },

        applicationSettingsIsTheActiveComponent: function() {
            if (this.activeComponent == 'application_settings') {
                return true;
            }

            return false;
        },

        frequentQuestionsIsTheActiveComponent: function() {
            if (this.activeComponent == 'frequent_questions') {
                return true;
            }
            return false;
        },

        ticketsIsTheActiveComponent: function() {
            if (this.activeComponent == 'tickets') {
                return true;
            }
            return false;
        },

        usersMetricsIsTheActiveComponent: function() {
            if (this.activeComponent == 'users_metrics') {
                return true;
            }

            return false;
        },

        productsMetricsIsTheActiveComponent: function() {
            if (this.activeComponent == 'products_metrics') {
                return true;
            }

            return false;
        },

        subscriptionsMetricsIsTheActiveComponent: function() {
            if (this.activeComponent == 'subscriptions_metrics') {
                return true;
            }

            return false;
        },

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

}

</script>
