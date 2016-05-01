<template>

    <div class="client-container">
        <div class="row">

            <client-header></client-header>
            <personal-informations></personal-informations>
            <notifications></notifications>
            <statistics></statistics>
            <bills></bills>

        </div>
    </div>
    </div>

</template>

<script>

import ClientHeader from '../components/ClientPage/ClientHeader.vue';
import Notifications from '../components/ClientPage/Notifications.vue';
import PersonalInformations from '../components/ClientPage/PersonalInformations.vue';
import Statistics from '../components/ClientPage/Statistics.vue';
import Bills from '../components/ClientPage/Bills.vue';

export default {

    components: {
        'client-header': ClientHeader,
        'notifications': Notifications,
        'personal-informations': PersonalInformations,
        'statistics': Statistics,
        'bills': Bills,
    }

}

</script>
