<template>

    <total-subscriptions :total-subscriptions="totalSubscriptions"></total-subscriptions>
    <active-subscriptions :active-subscriptions="activeSubscriptions"></active-subscriptions>
    <trial-subscriptions :trial-subscriptions="trialSubscriptions"></trial-subscriptions>
    <total-income :total-income="totalIncome"></total-income>

</template>

<script>

import TotalSubscriptions from '../../../components/AdminCenterPage/Metrics/Subscriptions/TotalSubscriptions.vue';
import ActiveSubscriptions from '../../../components/AdminCenterPage/Metrics/Subscriptions/ActiveSubscriptions.vue';
import TrialSubscriptions from '../../../components/AdminCenterPage/Metrics/Subscriptions/TrialSubscriptions.vue';
import TotalIncome from '../../../components/AdminCenterPage/Metrics/Subscriptions/TotalIncome.vue';

export default {

    components: {
        'total-subscriptions': TotalSubscriptions,
        'active-subscriptions': ActiveSubscriptions,
        'trial-subscriptions': TrialSubscriptions,
        'total-income': TotalIncome
    },

    ready: function() {
        this.getMetrics();
    },

    data: function() {
        return {
            totalSubscriptions: 0,
            activeSubscriptions: 0,
            trialSubscriptions: 0,
            totalIncome: 0
        }
    },

    methods: {

        getMetrics: function() {
            //
        }

    }

}

</script>
