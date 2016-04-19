<template>

    <div class="row">

        <div class="col-md-4">
            <settings :active="active"></settings>
            <displayed :active="active"></displayed>
        </div>

        <div class="col-md-8">

            <!-- BEGIN Settings group -->
            <profile v-if="activeComponent == 'profile'"></profile>
            <security v-if="activeComponent == 'security'"></security>
            <!-- END Settings group -->

            <!-- BEGIN Displayed group -->
            <number-of-bills v-if="activeComponent == 'bills'"></number-of-bills>
            <number-of-clients v-if="activeComponent == 'clients'"></number-of-clients>
            <!-- END Displayed group -->

        </div>
    </div>
</template>

<script>

import Settings from '../components/SettingsPage/Settings.vue';
import Displayed from '../components/SettingsPage/Displayed.vue';
import Profile from '../components/SettingsPage/Profile.vue';
import Security from '../components/SettingsPage/Security.vue';
import NumberOfBills from '../components/SettingsPage/NumberOfBills.vue';
import NumberOfClients from '../components/SettingsPage/NumberOfClients.vue';

export default {

    props: ['active'],

    data: function() {
        return {
            activeComponent: this.active
        }
    },

    components: {
        'settings': Settings,
        'profile': Profile,
        'security': Security,
        'displayed': Displayed,
        'number-of-bills': NumberOfBills,
        'number-of-clients': NumberOfClients
    },

    events: {
        'component_clicked': function() {
            swal({
                title: 'Se incarca...',
                type: 'info',
                showConfirmButton: false
            });
        }
    }

}
</script
