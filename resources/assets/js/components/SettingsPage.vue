<template>

    <div class="row">

        <div class="col-md-4">
            <settings :active="active"></settings>
        </div>

        <div class="col-md-8">

            <!-- BEGIN Settings group -->
            <profile v-if="activeComponent == 'profile'"></profile>
            <security v-if="activeComponent == 'security'"></security>
            <displayed v-if="activeComponent == 'displayed'"></displayed>
            <!-- END Settings group -->

        </div>
    </div>
</template>

<script>

import Settings from '../components/SettingsPage/Settings.vue';
import Displayed from '../components/SettingsPage/Displayed.vue';
import Profile from '../components/SettingsPage/Profile.vue';
import Security from '../components/SettingsPage/Security.vue';

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
