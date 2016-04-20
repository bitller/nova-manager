<template>

    <payments-history></payments-history>
    <extra-billing-information></extra-billing-information>

</template>

<script>

import PaymentsHistory from '../../../components/SettingsPage/Billing/Payments/PaymentsHistory.vue';
import ExtraBillingInformation from '../../../components/SettingsPage/Billing/Payments/ExtraBillingInformation.vue';

export default {

    components: {
        'payments-history': PaymentsHistory,
        'extra-billing-information': ExtraBillingInformation,
    }

}

</script>
