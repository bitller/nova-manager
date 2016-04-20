<template>

    <number-of-bills></number-of-bills>
    <number-of-clients></number-of-clients>

</template>

<script>

import NumberOfBills from '../../components/SettingsPage/Displayed/NumberOfBills.vue';
import NumberOfClients from '../../components/SettingsPage/Displayed/NumberOfClients.vue';

export default {

    components: {
        'number-of-bills': NumberOfBills,
        'number-of-clients': NumberOfClients
    }
    
}
</script>
