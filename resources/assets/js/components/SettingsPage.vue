<template>

    <div class="row">

        <div class="col-md-4">
            <settings :active="active"></settings>
            <billing :active="active"></billing>
        </div>

        <div class="col-md-8">

            <!-- BEGIN Settings group -->
            <profile v-if="profileIsTheActiveComponent"></profile>
            <security v-if="securityIsTheActiveComponent"></security>
            <displayed v-if="displayedIsTheActiveComponent"></displayed>
            <!-- END Settings group -->

            <!-- BEGIN Billing group -->
            <subscription-details v-if="subscriptionDetailsIsTheActiveComponent"></subscription-details>
            <payments v-if="paymentsIsTheActiveComponent"></payments>
            <credit-card v-if="creditCardIsTheActiveComponent"></credit-card>
            <!-- END Billing group -->

        </div>
    </div>
</template>

<script>

import Settings from '../components/SettingsPage/Settings.vue';
import Billing from '../components/SettingsPage/Billing.vue';

import Displayed from '../components/SettingsPage/Settings/Displayed.vue';
import Profile from '../components/SettingsPage/Settings/Profile.vue'
import Security from '../components/SettingsPage/Settings/Security.vue';
import SubscrptionDetails from '../components/SettingsPage/Billing/SubscriptionDetails.vue';
import Payments from '../components/SettingsPage/Billing/Payments.vue';
import CreditCard from '../components/SettingsPage/Billing/CreditCard.vue';

export default {

    props: ['active'],

    data: function() {
        return {
            activeComponent: this.active
        }
    },

    components: {
        'settings': Settings,
        'billing': Billing,
        'profile': Profile,
        'security': Security,
        'displayed': Displayed,
        'subscription-details': SubscrptionDetails,
        'payments': Payments,
        'credit-card': CreditCard,
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

        profileIsTheActiveComponent: function() {
            if (this.activeComponent == 'profile') {
                return true;
            }

            return false;
        },

        securityIsTheActiveComponent: function() {
            if (this.activeComponent == 'security') {
                return true;
            }

            return false;
        },

        displayedIsTheActiveComponent: function() {
            if (this.activeComponent == 'displayed') {
                return true;
            }

            return false;
        },

        subscriptionDetailsIsTheActiveComponent: function() {
            if (this.activeComponent == 'subscription_details') {
                return true;
            }

            return false;
        },

        paymentsIsTheActiveComponent: function() {
            if (this.activeComponent == 'payments') {
                return true;
            }

            return false;
        },

        creditCardIsTheActiveComponent: function() {
            if (this.activeComponent == 'credit_card') {
                return true;
            }

            return false;
        }

    }

}
</script
