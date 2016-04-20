<template>

    <number-of-bills></number-of-bills>
    <number-of-clients></number-of-clients>

</template>

<script>

import NumberOfBills from '../../../components/SettingsPage/Settings/Displayed/NumberOfBills.vue';
import NumberOfClients from '../../../components/SettingsPage/Settings/Displayed/NumberOfClients.vue';

export default {

    components: {
        'number-of-bills': NumberOfBills,
        'number-of-clients': NumberOfClients
    }

}
</script>
